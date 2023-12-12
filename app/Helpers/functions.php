<?php

use App\Enums\ClaimStatus as EnumsClaimStatus;
use App\Enums\OfficerTargetStatus;
use App\Helpers\Classes\HelperFunctionsCache;
use Carbon\Carbon;
use App\Models\Loan;
use App\Models\User;
use App\Models\Claim;
use App\Models\Reason;
use App\Models\Company;
use App\Models\Message;
use App\Models\payment;
use Twilio\Rest\Client;
use App\Models\PayDelay;
use App\Models\SadadPay;
use App\Models\ElmStatus;
use App\Models\ApproveLog;
use App\Models\CallStatus;
use App\Models\PartialPay;
use App\Models\ClaimRemark;
use App\Models\ClaimStatus;
use App\Models\PaymentLink;
use App\Models\SmsResponse;
use App\Models\DebtorRefuse;
use App\Models\Distribution;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\PartialManual;
use App\Models\SadadResponse;
use App\Models\StatusHistory;
use App\Models\Supported_Doc;
use App\Models\CollectedClaim;
use App\Models\DebtorResponse;
use App\Models\AdditionalSadad;
use App\Models\FinancialCompany;
use App\Helpers\Classes\Settings;
use App\Models\CustomPartialSadad;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notify_User_About_Loan_Delay_From_Financial_Company;
use App\Models\LegalDepartment;
use App\Models\OfficerTarget;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Current;

function customizedpartialsadadLink($id)
{

    //dd($price);
    $partialpay = PartialPay::where('id', $id)->first();
    $claim = Claim::where('id', $partialpay->claim_id)->first();
    // dd($claim);
    $idorder = 'PHP_' . rand(1, 10000000); //Customer Order ID

    if ($partialpay->amount == null) {
        $installement = PartialPay::where('claim_id', $claim->id)->where('type', 'sadad')->where('status', '<>', 5)->count();
        $amt = $claim->amount_after_discount / $installement;
    } else {
        $amt = $partialpay->amount;
    }



    $terminalId = env('SADAD_TERMINAL'); // Will be provided by URWAY
    $password = env('SADAD_PASSWORD'); // Will be provided by URWAY
    $merchant_key = env('SADAD_MERCHANT'); // Will be provided by URWAY
    $currencycode = "SAR";


    $issueDate = date("Y-m-d");

    $expiryDate = Carbon::now()->addDay(7)->format("Y-m-d");
    $unitPrice = $amt;
    //$vat=$unitPrice*0.15;
    //($unitPrice);
    //$amount=$unitPrice+$vat;
    $amount = $unitPrice;
    $mob = $claim->deb_mob;
    $reciever = substr($mob, 1);

    $ipp = "127.0.0.1";

    //Generate Hash
    $txn_details = $idorder . '|' . $terminalId . '|' . $password . '|' . $merchant_key . '|' . $amount . '|' . $currencycode;
    $hash = hash('sha256', $txn_details);
    $itemList = [
        "name" => "Recovery",
        "quantity" => "1",
        "discount" => "0",
        "discountType" => "FIXED",
        "vat" => "0",
        "unitPrice" => $unitPrice
    ];

    $sadatpay = [
        "billNumber" => "902",
        "customerFullName" => "Taheiya Recovery",
        "customerIdNumber" => "",
        "customerIdType" => "NAT",
        "customerEmailAddress" => "developer@taheiya.sa",
        "customerMobileNumber" => $reciever,
        "customerPreviousBalance" => "",
        "customerTaxNumber" => "",
        "issueDate" => $issueDate,
        "expireDate" => $expiryDate,
        "serviceName" => "Recovery",
        "buildingNumber" => "1234",
        "cityCode" => "12",
        "districtCode" => "1",
        "postalCode" => "22230",
        "billItemList" => json_encode($itemList),
        "isPartialAllowed" => "",
        "miniPartialAmount" => ""
    ];


    $fields = array(
        'trackid' => $idorder,
        'terminalId' => $terminalId,
        'action' => "17",  // action is always 1
        'merchantIp' => '9.10.10.102',
        'password' => $password,
        'currency' => $currencycode,
        'requestHash' => $hash,
        'country' => "SA",
        "amount" => $amount,
        "currency" => "SAR",
        "country" => "SA",
        "instrumentType" => "Default",
        "sadadPaymentDetails" => [$sadatpay],
        "smsLanguage" => "ar",
        "sendLinkMode" => "2",
        "udf1" => "Recovery",
        "udf2" => route('sadadResponse'),
        "udf3" => $claim->id,

    );
    //   return $fields;
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://payments-dev.urway-tech.com/PGServiceB2B/transaction/jsonProcess/JSONrequest',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($fields),
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);
    // return $response;
    $result = json_decode($response);
    // dd($result);
    if ($result->responseCode == '5005') {

        $sadad = new CustomPartialSadad();
        $sadad->claim_id = $claim->id;
        $sadad->partial_id = $id;
        $sadad->tranid = $result->tranid;
        $sadad->trackid = $result->trackid;
        $sadad->amount = $result->amount;
        $sadad->update_by = Auth::user()->id;
        $sadad->sadadNumber = $result->sadadNumber;
        $sadad->hashResponse = $result->responseHash;
        $sadad->billNumber = $result->billNumber;
        $sadad->save();

        $claimid = "902";
        $amt = $amount;
        $sada = $result->sadadNumber;
        $message = "عزيزي العميل تم اصدار فاتورة سداد بمبلغ قدره" . $amt . " ريال سعودي بالرقم المرجعي" . $sada . " برجاء دفع الفاتورة من خلال الخيار" . $claimid .

            "شكرا وتحياتي";

        $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
            "userName" => "Taheiya",
            "numbers" => $reciever,
            "userSender" => "Taheiya",
            "apiKey" => env('MSEGAT_API_KEY'),
            "msg" => $message
        ]);
        $data = json_decode($response->getBody(), true);

        if ($data['code'] == 1) {
            $smsres = new SmsResponse;
            $smsres->claim_id = $id;
            $smsres->code = $data['code'];
            $smsres->phone_no = $reciever;
            $smsres->message = $data['message'];
            $smsres->sms = $message;
            $smsres->save();
        } else {
            return "604";
        }

        return $result->sadadNumber;
    } else {
        return "504";
    }
}

function statusHistory($claimid, $status, $userid)
{

    $valid = 1;
    try {
        $history = new StatusHistory();
        $history->claim_id = $claimid;
        $history->update_by = $userid;
        $history->status = $status;
        $history->save();

        return $valid;
    } catch (\Exception $e) {
        dd($e);
        $valid = 0;
        return $valid;
    }
}


function getClaimStatus($id)
{
    $status = ClaimStatus::where('claim_id', $id)->first();
    if ($status) {
        return $status->status;
    } else {
        return '0';
    }
}

function rescompany($id)
{
    // dd($id);
    $claim = Claim::where('id', $id)->select('company_id')->first();
    //dd($claim);
    if ($claim == null) {
        return "undefined";
    } else {
        $company = Company::where('id', $claim->company_id)->first();
        return $company->name;
    }
}

function getFinanceById($id)
{
    return FinancialCompany::where('id', $id)->first();
}

function getPhoneNumber($id)
{
    $claim = Claim::where('id', $id)->first();
    return $claim->deb_mob;
}


function getEmail($id)
{
    $user = User::where('id', $id)->first();
    return $user->email;
}

function isJson($str)
{
    $json = json_decode($str);
    return $json && $str != $json;
}
function generateRandomString($length = 10)
{
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}
function username($id)
{
    $user = User::where('id', $id)->first();
    // var_dump($user);
    return $user->name;
}

function removeslash($str)
{
    $str2 = str_replace("/", "-", $str);
    return $str2;
}
function addslash($str)
{
    $str2 = str_replace("-", "/", $str);
    return $str2;
}
function company($id)
{
    $company = Company::where('id', $id)->first();
    return $company;
}



function getCompanyById($id)
{
    return Company::where('id', $id)->first();
}
function getreason($id)
{
    return Claim::where('id', $id)->first();
}

function getdoc($id)
{
    $docs = Supported_Doc::where('claim_id', $id)->get();
    return $docs;
}

function allreason()
{
    $reasons = Reason::all();
    return $reasons;
}

function unmessage($id)
{
    return Message::where('status', 1)->where('receiver_id', Auth::user()->id)->get();
}

// Send Sms using Msegat
function adminSendMessage($reciever, $message, $claimid)
{

    $reciever = substr($reciever, 1);

    $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
        "userName" => "Taheiya",
        "numbers" => $reciever,
        "userSender" => "Taheiya",
        "apiKey" => env('MSEGAT_API_KEY'),
        "msg" => $message
    ]);
    $data = json_decode($response->getBody(), true);

    $smsres = new SmsResponse;
    $smsres->claim_id = $claimid;
    $smsres->code = $data['code'];
    $smsres->phone_no = $reciever;
    $smsres->message = $data['message'];
    $smsres->sms = $message;
    $smsres->save();
}


// Admin make Call
function initiateCall($to)
{
    $sid = "AC21984cbd1f00309652b4849a86c55678";
    $token = "4cbc37c50adac63ed549ca9436d2abd1";
    $twilio = new Client($sid, $token);

    try {
        $twilio->studio->v2->flows("FW53dbbc18b70dd94e5da10826b51af766")
            ->executions
            ->create($to, "+17373770921");
    } catch (Exception $error) {
        return redirect()->back()->with("errorMsg", "Call already in progress");
    }
    //    print($execution);
    return 0;
}

//company name using claim_id
function companyname($id)
{
    $cid = Claim::where('id', $id)->pluck('cid')->first();
    return User::where('id', $cid)->pluck('name')->first();
}

function checkobjection($id)
{
    return  DebtorResponse::where('claim_id', $id)->where('response', 1)->count();
}

function getobjection($id)
{
    return DebtorResponse::where('claim_id', $id)->latest()->first();
}

function getclaimbyid($id)
{
    return claim::where('id', $id)->first();
}

function getfirms()
{
    $firms = User::where('roll', 2)->where('idc', 'yes')->get();
    return $firms;
}
function supportdoc($id)
{
    $docs = Supported_Doc::where('claim_id', $id)->first();
    return $docs->doc_name;
}
function checkfirmassign($id)
{
    $refuse = DebtorResponse::where('id', $id)->first();
    return $refuse;
}

//get claim using debtorresponse id
function getclaimdetail($id)
{
    $res = DebtorResponse::where('id', $id)->where('response', 2)->pluck('claim_id')->first();
    $claim = Claim::where('id', $res)->first();
    return $claim;
}

// get debtor refuse id using claim
function debtrefuseid($id)
{
    $res = DebtorResponse::where('claim_id', $id)->where('response', 2)->first();
    $refuse = DebtorRefuse::where('debtorresponse_id', $res->id)->first();
    return $refuse;
}

//lawfirm name
function lawfirmname($id)
{
    return User::where('id', $id)->pluck('name')->first();
}

function allfcompanies()
{
    return User::where('roll', 3)->where('status', 1)->get();
}

// get payment from claim id
function paymentFromClaimId($claim_id)
{
    return payment::where('claim_id', $claim_id)->first();
}

function getClaimByPhoneNumber($phone)
{
    return Claim::where('deb_mob', $phone)->first();
}

function getClaimFromLoanId($claim_id)
{
    return Claim::where('id', $claim_id)->first();
}

function getUserFromCompanyId($comp_id)
{
    return User::where('id', $comp_id)->first();
}

function sendMailToFinancialCompanyForLoanPending()
{

    $loans = Loan::where('status', 0)->get();

    foreach ($loans as $loan) {
        $details = [
            'claim_id' => 'TR00' . getClaimFromLoanId($loan->id)->id,
            'loan_id' => 'TR00' . $loan->id,
            'c_name' => 'TR00' . getUserFromCompanyId(getClaimFromLoanId($loan->id)->cid),
        ];
    }

    Mail::to(getUserFromCompanyId(getClaimFromLoanId($loan->id)->cid)->email)->send(new Notify_User_About_Loan_Delay_From_Financial_Company($details));
}
// get notification
function getNotification()
{
    return Notification::where([
        ['to', Auth::user()->id],
        ['read', false]
    ])->get();
}
function getAdminNotification()
{
    return Notification::where([
        ['read', false]
    ])->get();
}

function getLawNotification()
{
    return Notification::where([
        ['to', Auth::user()->id],
        ['read', false]
    ])->get();
}

// notification counter
function countNotification()
{
    return Notification::where([
        ['to', Auth::user()->id],
        ['read', false]
    ])->count();
}
// admin notification counter
function countAdminNotification()
{
    return Notification::where([
        ['read', false]
    ])->count();
}
// lawfirm notification counter
function countlawNotification()
{
    return Notification::where([
        ['to', Auth::user()->id],
        ['read', false]
    ])->count();
}
function callufone($phone)
{
    $reciever = array($phone);
    $refernce_id = rand(1, 1000000) . time();


    $ivrdetail = array(

        "recipient" => $reciever,
        "type" => "ivr",
        "callerId" => "+966115219815",
        "referenceId" => $refernce_id,
        "ivr" => array(
            "play" => "684ac591-e1a9-4b2b-9a25-7f507156d3af",
            "responseUrl" => "https://unifonic2.requestcatcher.com/",
            "onEmptyResponse" => "We did not receive your response. Good bye.",
            "loop" => "1",
            "digitsLimit" => "1"
        ),

    );

    // dd(json_encode($card));
    //  $phone=json_encode($reciever);
    //  dd($phone);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://voice.unifonic.com/v1/calls',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($ivrdetail),
        CURLOPT_HTTPHEADER => array(
            'AppsId: lmfuLlmvVEKcOCMyxF1A',
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    //dd('ewe'.$response);
    return $response;
}

function iqamaSMS($batchnumber)
{
    $error = 1;
    $data = (object)
    array(
        'ClientId' => '7026274915',
        'ClientAuthorization' => 'hMrMOv3e70EUI87/G/kVAo/PtmKljsS3/0mi+gpEoNM=',
        'BatchNumber' => $batchnumber,

    );

    $wsdl           = 'https://api.absher.sa/AbsherSmsNotification?wsdl';
    $endpoint       = 'https://api.absher.sa/AbsherSmsNotification';
    $certificate    = './taheiya.pem';
    $password       = 'Abdullah123$';


    $options = array(
        'location'      => $endpoint,
        'keep_alive'    => true,
        'trace'         => true,
        'local_cert'    => $certificate,
        'passphrase'    => $password,
        'cache_wsdl'    => WSDL_CACHE_NONE,

    );
    try {

        $soapClient = new \SoapClient($wsdl, $options);
        $response1 = $soapClient->GetStatus($data);
        $batchidentifier = $response1->StatusResult->BatchIdentifier;

        $data = (object)
        array(
            'ClientId' => '7026274915',
            'ClientAuthorization' => 'hMrMOv3e70EUI87/G/kVAo/PtmKljsS3/0mi+gpEoNM=',
            'BatchIdentifier' => $batchidentifier,

        );



        //$soapClient = new \SoapClient($wsdl, $options);

        $response2 = $soapClient->GetDetailedStatus($data);
        $res = array(
            $response2->StatusDetailResult->Recipients->Recipient->NationalOrIqamaId,
            $response2->StatusDetailResult->Recipients->Recipient->StatusDescription
        );

        return  $response2->StatusDetailResult->Recipients->Recipient->StatusDescription;
    } catch (\Exception $e) {
        return  $e;
    }
}



function testsms($reciever, $message, $claimid)
{

    $reciever = substr($reciever, 1);

    $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
        "userName" => "Taheiya",
        "numbers" => $reciever,
        "userSender" => "Taheiya",
        "apiKey" => env('MSEGAT_API_KEY'),
        "msg" => $message
    ]);
    $data = json_decode($response->getBody(), true);

    $smsres = new SmsResponse;
    $smsres->claim_id = $claimid;
    $smsres->code = $data['code'];
    $smsres->phone_no = $reciever;
    $smsres->message = $data['message'];
    $smsres->save();
}
function distribution()
{
    $count = Claim::where('is_assign', 0)->count();
    $unassClaim = Claim::where('is_assign', 0)->get();


    $admins = User::where('roll', 0)->where('is_super', 0)->select('id')->get();

    $admincount = User::where('roll', 0)->where('is_super', 0)->count();

    if ($count != 0) {
        //dd('hell');
        $claimids = array();
        for ($i = 0; $i < $count; $i++) {
            $claimids[] =  $unassClaim[$i]->id;
        }
        $claimids;

        $adminids = array();
        for ($i = 0; $i < $admincount; $i++) {
            $adminids[] = $admins[$i]->id;
        }
        // return $adminids;
        // $k = array_rand($adminids);
        // unset($adminids[$k]);
        $claimdivide = $count / $admincount;

        //  unset($claimids[2]);
        // return $claimids;
        for ($r = 0; $r <= $admincount; $r++) {
            if (sizeof($claimids) == []) {
                break;
            } else {

                for ($e = 0; $e < $claimdivide; $e++) {
                    if ($claimids != []) {


                        $dis = new Distribution;
                        $dis->user_id = $adminids[$r];
                        $dis->claim_id = $claimids[0];
                        $dis->status = 0;
                        $dis->save();
                        Claim::where('id', $claimids[0])->update(['is_assign' => $adminids[$r]]);
                        unset($claimids[0]);
                        $claimids = array_values($claimids);
                        $count = $count - 1;
                    } else {
                        break;
                    }
                }
            }
        }

        return back()->with('success', 'All claims assigned successfully');
    } else {

        return back()->with('error', 'All claims already assigned');
    }
}

function redistribution()
{
    $count = Claim::where('is_assign', 0)->count();
    $unassClaim = Claim::where('is_assign', '<>', 0)->get();
    //dd($count);
    //                 for($e=0;$e<=$count;$e++){

    Claim::where('is_assign', '<>', 0)->update(['is_assign' => '0']);





    // }



    return 'All claims already assigned';
}


function reSendMessage($claimid)
{
    $claim = Claim::where('id', $claimid)->first();
    $reciever = $claim->deb_mob;

    $link = $claim->link;
    $companyname = getCompanyById($claim->company_id)->name;
    $message =
        "عزيزي العميل، نفيدكم بوجود مطالبة مالية لدى شركة " . $companyname . " الموحدة رقم المرجع " . $claim->id . " بمبلغ وقدره " . $claim->amount_after_discount . " ريال سعودي, لمزيد من المعلومات يرجى الاطلاع على المستندات من خلال الرابط " . $link . "  ، تذكر دائماً أن تهيئة لن تطلب أي أرقام سرية خاصة بكم بأي حال من الأحوال
";
    $reciever = substr($reciever, 1);

    $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
        "userName" => "Taheiya",
        "numbers" => $reciever,
        "userSender" => "Taheiya",
        "apiKey" => env('MSEGAT_API_KEY'),
        "msg" => $message
    ]);
    $data = json_decode($response->getBody(), true);

    $smsres = SmsResponse::where('claim_id', $claim->id)->first();
    $smsres->claim_id = $claim->id;
    $smsres->code = $data['code'];
    $smsres->phone_no = $reciever;
    $smsres->message = $data['message'];
    $smsres->sms = $message;
    $smsres->save();
}

function objectionStatus($claim)
{

    $res = DebtorResponse::where('claim_id', $claim)->first();
    if ($res != null) {
        if ($res->response == 1) {
            return 1;
        } else if ($res->response == 2) {
            return 2; //refuse
        } else if ($res->response == 3) {
            return 3; //direct pay
        }
    } else {
        return 0;
    }
}
function createPaymentLink()
{


    //$claim=Claim::where('id',$claimid)->first();

    $idorder = 'PHP_' . rand(1, 1000); //Customer Order ID


    $terminalId = env('URWAYS_TERMINAL'); // Will be provided by URWAY
    $password = env('URWAYS_PASSWORD'); // Will be provided by URWAY
    $merchant_key = env('URWAYS_MERCHANT'); // Will be provided by URWAY
    $currencycode = "SAR";
    $amount = 10;

    // $claim=Claim::where('id', $req->claim_id)->first();
    // $cemail=$claim->ic_mail;
    // if($cemail==null){
    $cemail = "zeeshangujjar443@gmail.com";
    // }





    $ipp = "127.0.0.1";

    //Generate Hash
    $txn_details = $idorder . '|' . $terminalId . '|' . $password . '|' . $merchant_key . '|' . $amount . '|' . $currencycode;
    $hash = hash('sha256', $txn_details);
    $response = Http::post('https://payments-dev.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest', [

        'trackid' => $idorder,
        'terminalId' => $terminalId,
        'customerEmail' => 'zeeshangujjar443@gmail.com',
        'action' => "1",  // action is always 1
        'merchantIp' => $ipp,
        'password' => $password,
        'currency' => $currencycode,
        'country' => "SA",
        'amount' => '10',
        "udf1"              => "Test1",
        "udf2"              => route('PaymentResponsePage'), //Response page URL
        "udf3"              => "",
        "udf4"              => "",
        "udf5"              => "Test5",
        "claim_id"              => '455',
        'requestHash' => $hash  //generated Hash


    ]);
    $data = json_decode($response->getBody(), true);

    // dd(env('URWAYS_TERMINAL'),env('URWAYS_PASSWORD'),env('URWAYS_MERCHANT'));
    $url =  $data['targetUrl'] . '?paymentid=' .   $data['payid'];
    dd($url);
}

function delayPamentLinks($claimid)
{

    $url = 1;

    try {
        $claim = Claim::where('id', $claimid)->first();
        $idorder = 'PHP_' . rand(1, 1000); //Customer Order ID
        $terminalId = env('URWAYS_TERMINAL'); // Will be provided by URWAY
        $password = env('URWAYS_PASSWORD'); // Will be provided by URWAY
        $merchant_key = env('URWAYS_MERCHANT'); // Will be provided by URWAY
        $currencycode = "SAR";
        $amount = $claim->amount_after_discount;


        $cemail = $claim->ic_mail;
        if ($cemail == null) {
            $cemail = "info@taheiya.com";
        }





        $ipp = "127.0.0.1";

        //Generate Hash
        $txn_details = $idorder . '|' . $terminalId . '|' . $password . '|' . $merchant_key . '|' . $amount . '|' . $currencycode;
        $hash = hash('sha256', $txn_details);



        $response = Http::post('https://payments-dev.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest', [

            'trackid' => $idorder,
            'terminalId' => $terminalId,
            'customerEmail' => $cemail,
            'action' => "1",  // action is always 1
            'merchantIp' => $ipp,
            'password' => $password,
            'currency' => $currencycode,
            'country' => "SA",
            'amount' => $amount,
            "udf1"              => "Test1",
            "udf2"              => route('PayDelayResponse'), //Response page URL
            "udf3"              => "",
            "udf4"              => "",
            "udf5"              => "Test5",
            "claim_id"              => $claim->id,
            'requestHash' => $hash  //generated Hash


        ]);
        $data = json_decode($response->getBody(), true);


        //$url =  $data['targetUrl'] . '?paymentid=' .   $data['payid'];
        $link =  $data['targetUrl'] . '?paymentid=' .   $data['payid'];
        $paymentid = $data['payid'];
        try {
            // $delaypay=PayDelay::where('claim_id',$claimid)->first();
            // $delaypay->pay_id=$data['payid'];
            // $delaypay->save();
            $url = [$link, $paymentid];
            return $url;
        } catch (\Exception $e) {
            $url = 3;
            return $url;
        }
    } catch (\Exception $e) {
        return $url;
    }
}

function createPaymentLinkAmt($claimid, $amount)
{

    $url = 1;

    try {
        $claim = Claim::where('id', $claimid)->first();
        $idorder = 'PHP_' . rand(1, 1000); //Customer Order ID
        $terminalId = env('URWAYS_TERMINAL'); // Will be provided by URWAY
        $password = env('URWAYS_PASSWORD'); // Will be provided by URWAY
        $merchant_key = env('URWAYS_MERCHANT'); // Will be provided by URWAY
        $currencycode = "SAR";
        $amount = $amount;


        $cemail = $claim->ic_mail;
        if ($cemail == null) {
            $cemail = "info@taheiya.com";
        }





        $ipp = "127.0.0.1";

        //Generate Hash
        $txn_details = $idorder . '|' . $terminalId . '|' . $password . '|' . $merchant_key . '|' . $amount . '|' . $currencycode;
        $hash = hash('sha256', $txn_details);



        $response = Http::post('https://payments-dev.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest', [

            'trackid' => $idorder,
            'terminalId' => $terminalId,
            'customerEmail' => 'info@taheiya.sa',
            'action' => "1",  // action is always 1
            'merchantIp' => $ipp,
            'password' => $password,
            'currency' => $currencycode,
            'country' => "SA",
            'amount' => $amount,
            "udf1"              => "Test1",
            "udf2"              => route('PartialPayResponse'), //Response page URL 'PaymentResponsePage'
            "udf3"              => "",
            "udf4"              => "",
            "udf5"              => "Test5",
            "claim_id"              => $claim->id,
            'requestHash' => $hash  //generated Hash


        ]);
        $data = json_decode($response->getBody(), true);


        $link =  $data['targetUrl'] . '?paymentid=' .   $data['payid'];
        $paymentid = $data['payid'];
        try {
            // $delaypay=PartialPay::where('claim_id',$claimid)->first();
            // $delaypay->pay_id=$data['payid'];
            // $delaypay->save();
            //dd($delaypay);
            $url = [$link, $paymentid];
            return $url;
        } catch (\Exception $e) {
            $url = 3;
            return $url;
        }
    } catch (\Exception $e) {
        return $url;
    }
}
function claimstatus($claimid){
    $status=0;
    
    $claim=ClaimStatus::where('claim_id',$claimid)->first();

    $claimStatus=ClaimStatus::where('claim_id',$claimid)->first();

    // if($claimStatus->status == EnumsClaimStatus::SEND_TO_LEGAL_DEPARTMENT->value){
    //     return $claimStatus->status;
    // }
   
    if($claim!=null){
        
        if($claim->status==1){
            $status=1;
            return $status;
        }
        else if($claim->status==2){
            $status=2;
            return $status;
        }else if($claim->status==3){
            $status=3;
            return $status;
        }else if($claim->status==4){
            $status=4;
            return $status;
        }else if($claim->status==5){
            $status=5;
            return $status;
        }else if($claim->status==6){
            $status=6;
            return $status;
        }else if($claim->status==7){
            $status=7;
            return $status;
        }else if($claim->status==8){
            $status=8;
            return $status;
        }else if($claim->status==9){
            $status=9;
            return $status;
        }else if($claim->status==10){
            $status=10;
            return $status;
        }else if($claim->status == 11){
            $status = 19;
            return $status;
        }else if($claim->status == 15){
            $status = 20;
            return $status;
        }
        else if($claim->status == 16){
            $status = 21;
            return $status;
        }else if($claim->status == 20){
            $status = 20;
            return 20;
        }
        else if($claim->status == 21){
            $status = 21;
            return $status;
        }elseif($claim->status == 22){
            $status = 22;
            return $status;
        }

    }else{
        $claim=Claim::where('id',$claimid)->first();
        
        if ($claim->status == 0){
           // Registered;
            $status=11;
            return $status;
        }else if($claim->status==20){
             $status=16;
            return $status;
        }
        else if($claim->status==1 && objectionStatus($claim->id)==1){
           // Objection
           $status=14;
            return $status;
        }
        
        elseif($claim->status==1 && objectionStatus($claim->id)==2){
           // Refused
           $status=15;
            return $status;
        }
      
        else if($claim->pay_status==1 && objectionStatus($claim->id)==3){
           // Direct Pay
           $status=16;
            return $status;
        }
       
       
        else if($claim->status==4){
            //Closed
            $status=12;
            return $status;
        }
       
        else if($claim->status==3){
            //Collected
            $status=13;
            return $status;
        }
      
        
      
        else if($claim->status==1) {
            //Approved
            $status=17;
            return $status;
            
        }
       
        else if($claim->status==2){
            $status=18;
            return $status;
           // Rejected
        }else{
            // Follow Up
            $status=0;
            return $status;
        }
        
    }
}

function sadadLink($id)
{


    $claim = Claim::where('id', $id)->first();

    $idorder = 'PHP_' . rand(1, 10000000); //Customer Order ID




    $terminalId = env('SADAD_TERMINAL'); // Will be provided by URWAY
    $password = env('SADAD_PASSWORD'); // Will be provided by URWAY
    $merchant_key = env('SADAD_MERCHANT'); // Will be provided by URWAY
    $currencycode = "SAR";

    $issueDate = date("Y-m-d");

    $expiryDate = Carbon::now()->addDay(7)->format("Y-m-d");
    $unitPrice = $claim->amount_after_discount;
    //$vat=$unitPrice*0.15;

    //$amount=$unitPrice+$vat;
    $amount = $unitPrice;
    $mob = $claim->deb_mob;
    $reciever = substr($mob, 1);

    $ipp = "127.0.0.1";

    //Generate Hash
    $txn_details = $idorder . '|' . $terminalId . '|' . $password . '|' . $merchant_key . '|' . $amount . '|' . $currencycode;
    $hash = hash('sha256', $txn_details);
    $itemList = [
        "name" => "Recovery",
        "quantity" => "1",
        "discount" => "0",
        "discountType" => "FIXED",
        "vat" => "0",
        "unitPrice" => $unitPrice
    ];

    $sadatpay = [
        "billNumber" => "902",
        "customerFullName" => "Taheiya Recovery",
        "customerIdNumber" => "",
        "customerIdType" => "NAT",
        "customerEmailAddress" => "developer@taheiya.sa",
        "customerMobileNumber" => $reciever,
        "customerPreviousBalance" => "",
        "customerTaxNumber" => "",
        "issueDate" => $issueDate,
        "expireDate" => $expiryDate,
        "serviceName" => "Recovery",
        "buildingNumber" => "1234",
        "cityCode" => "12",
        "districtCode" => "1",
        "postalCode" => "22230",
        "billItemList" => json_encode($itemList),
        "isPartialAllowed" => "",
        "miniPartialAmount" => ""
    ];


    $fields = array(
        'trackid' => $idorder,
        'terminalId' => $terminalId,
        'action' => "17",  // action is always 1
        'merchantIp' => '9.10.10.102',
        'password' => $password,
        'currency' => $currencycode,
        'requestHash' => $hash,
        'country' => "SA",
        "amount" => $amount,
        "currency" => "SAR",
        "country" => "SA",
        "instrumentType" => "Default",
        "sadadPaymentDetails" => [$sadatpay],
        "smsLanguage" => "ar",
        "sendLinkMode" => "2",
        "udf1" => "Recovery",
        "udf2" => route('sadadResponse'),
        "udf3" => $claim->id,

    );
    //return $fields;
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://payments-dev.urway-tech.com/PGServiceB2B/transaction/jsonProcess/JSONrequest',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($fields),
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);
    // dd($response);
    $result = json_decode($response);
    if ($result->responseCode == 5005) {

        $sadad = new SadadPay();
        $sadad->claim_id = $claim->id;
        $sadad->tranid = $result->tranid;
        $sadad->trackid = $result->trackid;
        $sadad->amount = $result->amount;
        $sadad->sadadNumber = $result->sadadNumber;
        $sadad->hashResponse = $result->responseHash;
        $sadad->billNumber = $result->billNumber;
        $sadad->save();

        $claimid = "902";
        $amt = $amount;
        $sada = $result->sadadNumber;
        $message = "عزيزي العميل تم اصدار فاتورة سداد بمبلغ قدره" . $amt . " ريال سعودي بالرقم المرجعي" . $sada . " برجاء دفع الفاتورة من خلال الخيار" . $claimid .

            "شكرا وتحياتي";

        $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
            "userName" => "Taheiya",
            "numbers" => $reciever,
            "userSender" => "Taheiya",
            "apiKey" => env('MSEGAT_API_KEY'),
            "msg" => $message
        ]);
        $data = json_decode($response->getBody(), true);

        if ($data['code'] == 1) {
            $smsres = new SmsResponse;
            $smsres->claim_id = $id;
            $smsres->code = $data['code'];
            $smsres->phone_no = $reciever;
            $smsres->message = $data['message'];
            $smsres->sms = $message;
            $smsres->save();
        } else {
            return back()->with('error', 'Sms not sent');
        }

        return back()->with('success', 'Sadad Link Created Successfully');
    } else {
        return back()->with('error', 'Something went wrong');
    }
}
function additionalsadadLink($id)
{


    $claim = Claim::where('id', $id)->first();

    $idorder = 'PHP_' . rand(1, 10000000); //Customer Order ID




    $terminalId = env('SADAD_TERMINAL'); // Will be provided by URWAY
    $password = env('SADAD_PASSWORD'); // Will be provided by URWAY
    $merchant_key = env('SADAD_MERCHANT'); // Will be provided by URWAY
    $currencycode = "SAR";

    $issueDate = date("Y-m-d");

    $expiryDate = Carbon::now()->addDay(7)->format("Y-m-d");
    $unitPrice = $claim->amount_after_discount;
    //$vat=$unitPrice*0.15;

    //$amount=$unitPrice+$vat;
    $amount = $unitPrice;
    $mob = $claim->deb_mob;
    $reciever = substr($mob, 1);

    $ipp = "127.0.0.1";

    //Generate Hash
    $txn_details = $idorder . '|' . $terminalId . '|' . $password . '|' . $merchant_key . '|' . $amount . '|' . $currencycode;
    $hash = hash('sha256', $txn_details);
    $itemList = [
        "name" => "Recovery",
        "quantity" => "1",
        "discount" => "0",
        "discountType" => "FIXED",
        "vat" => "0",
        "unitPrice" => $unitPrice
    ];

    $sadatpay = [
        "billNumber" => "902",
        "customerFullName" => "Taheiya Recovery",
        "customerIdNumber" => "",
        "customerIdType" => "NAT",
        "customerEmailAddress" => "developer@taheiya.sa",
        "customerMobileNumber" => $reciever,
        "customerPreviousBalance" => "",
        "customerTaxNumber" => "",
        "issueDate" => $issueDate,
        "expireDate" => $expiryDate,
        "serviceName" => "Recovery",
        "buildingNumber" => "1234",
        "cityCode" => "12",
        "districtCode" => "1",
        "postalCode" => "22230",
        "billItemList" => json_encode($itemList),
        "isPartialAllowed" => "",
        "miniPartialAmount" => ""
    ];


    $fields = array(
        'trackid' => $idorder,
        'terminalId' => $terminalId,
        'action' => "17",  // action is always 1
        'merchantIp' => '9.10.10.102',
        'password' => $password,
        'currency' => $currencycode,
        'requestHash' => $hash,
        'country' => "SA",
        "amount" => $amount,
        "currency" => "SAR",
        "country" => "SA",
        "instrumentType" => "Default",
        "sadadPaymentDetails" => [$sadatpay],
        "smsLanguage" => "ar",
        "sendLinkMode" => "2",
        "udf1" => "Recovery",
        "udf2" => route('sadadResponse'),
        "udf3" => $claim->id,

    );
    //return $fields;
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://payments-dev.urway-tech.com/PGServiceB2B/transaction/jsonProcess/JSONrequest',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($fields),
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);
    // dd($response);
    $result = json_decode($response);
    if ($result->responseCode == 5005) {

        $sadad = new AdditionalSadad();
        $sadad->update_by = Auth::user()->id;
        $sadad->claim_id = $claim->id;
        $sadad->tranid = $result->tranid;
        $sadad->trackid = $result->trackid;
        $sadad->amount = $result->amount;
        $sadad->sadadNumber = $result->sadadNumber;
        $sadad->hashResponse = $result->responseHash;
        $sadad->billNumber = $result->billNumber;
        $sadad->save();

        $claimid = "902";
        $amt = $amount;
        $sada = $result->sadadNumber;
        $message = "عزيزي العميل تم اصدار فاتورة سداد بمبلغ قدره" . $amt . " ريال سعودي بالرقم المرجعي" . $sada . " برجاء دفع الفاتورة من خلال الخيار" . $claimid .

            "شكرا وتحياتي";

        $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
            "userName" => "Taheiya",
            "numbers" => $reciever,
            "userSender" => "Taheiya",
            "apiKey" => env('MSEGAT_API_KEY'),
            "msg" => $message
        ]);
        $data = json_decode($response->getBody(), true);

        if ($data['code'] == 1) {
            $smsres = new SmsResponse;
            $smsres->claim_id = $id;
            $smsres->code = $data['code'];
            $smsres->phone_no = $reciever;
            $smsres->message = $data['message'];
            $smsres->sms = $message;
            $smsres->save();
        } else {
            return back()->with('error', 'Sms not sent');
        }

        return back()->with('success', 'Sadad Link Created Successfully');
    } else {
        return back()->with('error', 'Something went wrong');
    }
}
function partialsadadLink($id, $amt)
{

    //dd($price);
    $claim = Claim::where('id', $id)->first();
    // dd($claim);
    $idorder = 'PHP_' . rand(1, 10000000); //Customer Order ID




    $terminalId = env('SADAD_TERMINAL'); // Will be provided by URWAY
    $password = env('SADAD_PASSWORD'); // Will be provided by URWAY
    $merchant_key = env('SADAD_MERCHANT'); // Will be provided by URWAY
    $currencycode = "SAR";


    $issueDate = date("Y-m-d");

    $expiryDate = Carbon::now()->addDay(7)->format("Y-m-d");
    $unitPrice = $amt;
    //$vat=$unitPrice*0.15;
    //($unitPrice);
    //$amount=$unitPrice+$vat;
    $amount = $unitPrice;
    $mob = $claim->deb_mob;
    $reciever = substr($mob, 1);

    $ipp = "127.0.0.1";

    //Generate Hash
    $txn_details = $idorder . '|' . $terminalId . '|' . $password . '|' . $merchant_key . '|' . $amount . '|' . $currencycode;
    $hash = hash('sha256', $txn_details);
    $itemList = [
        "name" => "Recovery",
        "quantity" => "1",
        "discount" => "0",
        "discountType" => "FIXED",
        "vat" => "0",
        "unitPrice" => $unitPrice
    ];

    $sadatpay = [
        "billNumber" => "902",
        "customerFullName" => "Taheiya Recovery",
        "customerIdNumber" => "",
        "customerIdType" => "NAT",
        "customerEmailAddress" => "developer@taheiya.sa",
        "customerMobileNumber" => $reciever,
        "customerPreviousBalance" => "",
        "customerTaxNumber" => "",
        "issueDate" => $issueDate,
        "expireDate" => $expiryDate,
        "serviceName" => "Recovery",
        "buildingNumber" => "1234",
        "cityCode" => "12",
        "districtCode" => "1",
        "postalCode" => "22230",
        "billItemList" => json_encode($itemList),
        "isPartialAllowed" => "",
        "miniPartialAmount" => ""
    ];


    $fields = array(
        'trackid' => $idorder,
        'terminalId' => $terminalId,
        'action' => "17",  // action is always 1
        'merchantIp' => '9.10.10.102',
        'password' => $password,
        'currency' => $currencycode,
        'requestHash' => $hash,
        'country' => "SA",
        "amount" => $amount,
        "currency" => "SAR",
        "country" => "SA",
        "instrumentType" => "Default",
        "sadadPaymentDetails" => [$sadatpay],
        "smsLanguage" => "ar",
        "sendLinkMode" => "2",
        "udf1" => "Recovery",
        "udf2" => route('sadadResponse'),
        "udf3" => $claim->id,
    );
    //   return $fields;
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://payments-dev.urway-tech.com/PGServiceB2B/transaction/jsonProcess/JSONrequest',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($fields),
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);
    //return $response;
    $result = json_decode($response);
    if ($result->responseCode == 5005) {

        $sadad = new SadadPay();
        $sadad->claim_id = $claim->id;
        $sadad->tranid = $result->tranid;
        $sadad->trackid = $result->trackid;
        $sadad->amount = $result->amount;
        $sadad->sadadNumber = $result->sadadNumber;
        $sadad->hashResponse = $result->responseHash;
        $sadad->billNumber = $result->billNumber;
        $sadad->save();

        $claimid = "902";
        $amt = $amount;
        $sada = $result->sadadNumber;
        $message = "عزيزي العميل تم اصدار فاتورة سداد بمبلغ قدره" . $amt . " ريال سعودي بالرقم المرجعي" . $sada . " برجاء دفع الفاتورة من خلال الخيار" . $claimid .

            "شكرا وتحياتي";

        $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
            "userName" => "Taheiya",
            "numbers" => $reciever,
            "userSender" => "Taheiya",
            "apiKey" => env('MSEGAT_API_KEY'),
            "msg" => $message
        ]);
        $data = json_decode($response->getBody(), true);

        if ($data['code'] == 1) {
            $smsres = new SmsResponse;
            $smsres->claim_id = $id;
            $smsres->code = $data['code'];
            $smsres->phone_no = $reciever;
            $smsres->message = $data['message'];
            $smsres->sms = $message;
            $smsres->save();
        } else {
            return "604";
        }

        return $result->sadadNumber;
    } else {
        return "504";
    }
}


function custompartialsadadLink($id, $amt)
{

    //dd($price);
    $claim = Claim::where('id', $id)->first();
    // dd($claim);
    $idorder = 'PHP_' . rand(1, 10000000); //Customer Order ID




    $terminalId = env('SADAD_TERMINAL'); // Will be provided by URWAY
    $password = env('SADAD_PASSWORD'); // Will be provided by URWAY
    $merchant_key = env('SADAD_MERCHANT'); // Will be provided by URWAY
    $currencycode = "SAR";


    $issueDate = date("Y-m-d");

    $expiryDate = Carbon::now()->addDay(7)->format("Y-m-d");
    $unitPrice = $amt;
    //$vat=$unitPrice*0.15;
    //($unitPrice);
    //$amount=$unitPrice+$vat;
    $amount = $unitPrice;
    $mob = $claim->deb_mob;
    $reciever = substr($mob, 1);

    $ipp = "127.0.0.1";

    //Generate Hash
    $txn_details = $idorder . '|' . $terminalId . '|' . $password . '|' . $merchant_key . '|' . $amount . '|' . $currencycode;
    $hash = hash('sha256', $txn_details);
    $itemList = [
        "name" => "Recovery",
        "quantity" => "1",
        "discount" => "0",
        "discountType" => "FIXED",
        "vat" => "0",
        "unitPrice" => $unitPrice
    ];

    $sadatpay = [
        "billNumber" => "902",
        "customerFullName" => "Taheiya Recovery",
        "customerIdNumber" => "",
        "customerIdType" => "NAT",
        "customerEmailAddress" => "developer@taheiya.sa",
        "customerMobileNumber" => $reciever,
        "customerPreviousBalance" => "",
        "customerTaxNumber" => "",
        "issueDate" => $issueDate,
        "expireDate" => $expiryDate,
        "serviceName" => "Recovery",
        "buildingNumber" => "1234",
        "cityCode" => "12",
        "districtCode" => "1",
        "postalCode" => "22230",
        "billItemList" => json_encode($itemList),
        "isPartialAllowed" => "",
        "miniPartialAmount" => ""
    ];


    $fields = array(
        'trackid' => $idorder,
        'terminalId' => $terminalId,
        'action' => "17",  // action is always 1
        'merchantIp' => '9.10.10.102',
        'password' => $password,
        'currency' => $currencycode,
        'requestHash' => $hash,
        'country' => "SA",
        "amount" => $amount,
        "currency" => "SAR",
        "country" => "SA",
        "instrumentType" => "Default",
        "sadadPaymentDetails" => [$sadatpay],
        "smsLanguage" => "ar",
        "sendLinkMode" => "2",
        "udf1" => "Recovery",
        "udf2" => route('sadadResponse'),
        "udf3" => $claim->id,

    );
    //   return $fields;
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://payments-dev.urway-tech.com/PGServiceB2B/transaction/jsonProcess/JSONrequest',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($fields),
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);
    // return $response;
    $result = json_decode($response);
    //dd($result->responseCode);
    if ($result->responseCode == '5005') {

        $sadad = new AdditionalSadad();
        $sadad->claim_id = $claim->id;
        $sadad->tranid = $result->tranid;
        $sadad->trackid = $result->trackid;
        $sadad->amount = $result->amount;
        $sadad->update_by = Auth::user()->id;
        $sadad->sadadNumber = $result->sadadNumber;
        $sadad->hashResponse = $result->responseHash;
        $sadad->billNumber = $result->billNumber;
        $sadad->save();

        $claimid = "902";
        $amt = $amount;
        $sada = $result->sadadNumber;
        $message = "عزيزي العميل تم اصدار فاتورة سداد بمبلغ قدره" . $amt . " ريال سعودي بالرقم المرجعي" . $sada . " برجاء دفع الفاتورة من خلال الخيار" . $claimid .

            "شكرا وتحياتي";

        $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
            "userName" => "Taheiya",
            "numbers" => $reciever,
            "userSender" => "Taheiya",
            "apiKey" => env('MSEGAT_API_KEY'),
            "msg" => $message
        ]);
        $data = json_decode($response->getBody(), true);

        if ($data['code'] == 1) {
            $smsres = new SmsResponse;
            $smsres->claim_id = $id;
            $smsres->code = $data['code'];
            $smsres->phone_no = $reciever;
            $smsres->message = $data['message'];
            $smsres->sms = $message;
            $smsres->save();
        } else {
            return "604";
        }

        return $result->sadadNumber;
    } else {
        return "504";
    }
}

function collectedVia($claimid)
{

    $collectedclaim = CollectedClaim::where('claim_id', $claimid)->count();
    $linkpayment = Payment::where('claim_id', $claimid)->where('result', 'Successful')->count();
    if ($collectedclaim > 0) {
        $collectedclaim = CollectedClaim::where('claim_id', $claimid)->first();
        $cVia = [$collectedclaim->payment, $collectedclaim->created_at];

        return $cVia;
    } else if ($linkpayment > 0) {


        $linkpayment = Payment::where('claim_id', $claimid)->where('result', 'Successful')->sum('amount');

        $payment = Payment::where('claim_id', $claimid)->where('result', 'Successful')->select('created_at')
            ->latest()->get();

        $claimamt = Claim::where('id', $claimid)->select('rec_amt')->first();

        if ($linkpayment ==  $claimamt->amount_after_discount) {

            $pay = [$payment[0]->created_at, 'Link Payment'];

            return $pay;
        } else {
            $rec = [$payment[0]->created_at, 'Recovered ' . $linkpayment];
            return $rec;
        }
    } else {
        return 'N/A';
    }
}

function approveDate($id)
{

    try {
        $approve = new ApproveLog;
        $approve->claim_id = $id;
        $approve->approved_by = Auth::user()->id;
        $approve->save();
    } catch (\Exception $e) {
        return 0;
    }
}

function partialCheck($payid, $claimid, $partial_id, $link)
{


    try {

        $payment = payment::where('payment_id', $payid)->where('claim_id', $claimid)->where('response_code', 000)->first();
        $paymentLink = DB::table('payment_links')->where('claim_id', $claimid)->get();
        $payment1 = PartialManual::where('partial_id', $partial_id)->where('claim_id', $claimid)->first();
        if ($link != null) {
            $sadad = SadadResponse::where('sadadNumber', $link)->where('claimid', $claimid)->first();
        }

        if ($payment != null) {
            return $payment->amount . " " . "/" . " " . $payment->created_at;
        } else if ($payment1 != null) {
            return $payment1->amount . " " . "/" . " " . $payment1->created_at;
        } else if ($sadad !=  null) {
            return $sadad->amount . " " . "/" . " " . $sadad->created_at;
        } else {
            return '';
            // return 0;
        }
    } catch (\Exception $e) {
        return '';
    }
}


function customPartialCheck($claimid, $payid)
{
    $payment = payment::where('payment_id', $payid)->where('claim_id', $claimid)->where('response_code', 000)->first();
    $sadad = SadadResponse::where('claimid', $claimid)->where('sadadNumber', $payid)->where('responseCode', 000)->first();
    if ($payment != null) {
        return $payment->amount . " " . "/" . " " . $payment->created_at;
    } else if ($sadad != null) {
        return $sadad->amount . " " . "/" . " " . $sadad->created_at;
    } else {
        // return 0;
        return '';
    }
}




function recoveryAmt($claimid)
{
    $payment = payment::where('claim_id', $claimid)->where('response_code', 000)->sum('amount');
    $sadad = SadadResponse::where('claimid', $claimid)->where('responseCode', 000)->sum('amount');
    $manual = PartialManual::where('claim_id', $claimid)->sum('amount');
    if ($payment != null || $sadad != null || $manual != null) {
        return $payment + $sadad + $manual;
    } else {
        return 0;
    }
}




function numberofPartial($claimid)
{
    $installment = PartialPay::where('claim_id', $claimid)->where('status', '<>', 5)->count();
    if ($installment == 0) {
        return 'N/A';
    } else {
        return $installment;
    }
}

function partialDetail($claimid)
{
    $installment = PartialPay::where('claim_id', $claimid)->where('status', '<>', 5)->get();
    if ($installment !== null) {
        return $installment;
    } else {
        return 'N/A';
    }
}
function partialRecovered($payment_id)
{
    $payment = payment::where('payment_id', $payment_id)->where('response_code', '000')->select('amount')->first();
    if ($payment !== null) {
        return $payment->amount;
    } else {
        return '0';
    }
}

function additionalPartialLink($claimid)
{
    $payment = PaymentLink::where('claim_id', $claimid)->count();

    if ($payment == 0) {
        return 'N/A';
    } else {
        return $payment;
    }
}
function additionalLinkRec($claimid)
{
    $payment = PaymentLink::join('payment', 'payment.payment_id', '=', 'payment_links.payment_id')
        ->where('payment_links.claim_id', $claimid)->where('payment_links.status', 2)->where('payment.response_code', '000')->get();

    if ($payment !== null) {
        return $payment;
    } else {
        return 'N/A';
    }
}


function partialPayedAmt($id)
{

    $partial = PartialPay::find($id);
    if ($partial->partialpayee !== null) {
        $amount = $partial->partialpayee->amount;
        return $amount;
    } else {
        return 0;
    }
}

function amountRecovered($id)
{
    $linkpayment = payment::where('claim_id', $id)->where('response_code', '000')->sum('amount');

    $manualpay = PartialManual::where('claim_id', $id)->sum('amount');

    $sadadpay = SadadResponse::where('claimid', $id)->where('responseCode', '000')->sum('amount');

    return $linkpayment + $manualpay + $sadadpay;
}
function payidcheck($pay_id)
{

    $pay = payment::where('payment_id', $pay_id)->where('response_code', 000)->count();
    if ($pay == 0) {
        return 'Not Recovered';
    } else {
        $pay = payment::where('payment_id', $pay_id)->where('response_code', 000)->first();
        return 'Recovered' . '' . $pay->amount;
    }
}

function additionalcheck($pay_id)
{

    $pay = payment::where('payment_id', $pay_id)->where('response_code', 000)->count();
    if ($pay == 0) {
        return 'Not Recovered';
    } else {
        $pay = payment::where('payment_id', $pay_id)->where('response_code', 000)->first();
        return 'Recovered' . '' . $pay->amount;
    }
}

function sadadPayedCheck($sadadnumber)
{
    $sadad = SadadResponse::where('sadadNumber', $sadadnumber)->where('responseCode', 000)->count();
    if ($sadad == 0) {
        return 'Not Recovered';
    } else {
        $sadad = SadadResponse::where('sadadNumber', $sadadnumber)->where('responseCode', 000)->select('amount')->first();
        return 'Recovered' . ' ' . $sadad->amount;
    }
}

function additionalSadadCheck($sadadnumber)
{
    $sadad = SadadResponse::where('sadadNumber', $sadadnumber)->where('responseCode', 000)->count();
    if ($sadad == 0) {
        return 'Not Recovered';
    } else {
        $sadad = SadadResponse::where('sadadNumber', $sadadnumber)->where('responseCode', 000)->select('amount')->first();
        return 'Recovered' . ' ' . $sadad->amount;
    }
}


function delaySadadLink($id, $delayId)
{

    //dd($price);
    $claim = Claim::where('id', $id)->first();
    // dd($claim);
    $idorder = 'PHP_' . rand(1, 10000000); //Customer Order ID




    $terminalId = env('SADAD_TERMINAL'); // Will be provided by URWAY
    $password = env('SADAD_PASSWORD'); // Will be provided by URWAY
    $merchant_key = env('SADAD_MERCHANT'); // Will be provided by URWAY
    $currencycode = "SAR";


    $issueDate = date("Y-m-d");

    $expiryDate = Carbon::now()->addDay(7)->format("Y-m-d");
    $unitPrice = $claim->amount_after_discount;
    //$vat=$unitPrice*0.15;
    //($unitPrice);
    //$amount=$unitPrice+$vat;
    $amount = $unitPrice;
    $mob = $claim->deb_mob;
    $reciever = substr($mob, 1);

    $ipp = "127.0.0.1";

    //Generate Hash
    $txn_details = $idorder . '|' . $terminalId . '|' . $password . '|' . $merchant_key . '|' . $amount . '|' . $currencycode;
    $hash = hash('sha256', $txn_details);
    $itemList = [
        "name" => "Recovery",
        "quantity" => "1",
        "discount" => "0",
        "discountType" => "FIXED",
        "vat" => "0",
        "unitPrice" => $unitPrice
    ];

    $sadatpay = [
        "billNumber" => "902",
        "customerFullName" => "Taheiya Recovery",
        "customerIdNumber" => "",
        "customerIdType" => "NAT",
        "customerEmailAddress" => "developer@taheiya.sa",
        "customerMobileNumber" => $reciever,
        "customerPreviousBalance" => "",
        "customerTaxNumber" => "",
        "issueDate" => $issueDate,
        "expireDate" => $expiryDate,
        "serviceName" => "Recovery",
        "buildingNumber" => "1234",
        "cityCode" => "12",
        "districtCode" => "1",
        "postalCode" => "22230",
        "billItemList" => json_encode($itemList),
        "isPartialAllowed" => "",
        "miniPartialAmount" => ""
    ];


    $fields = array(
        'trackid' => $idorder,
        'terminalId' => $terminalId,
        'action' => "17",  // action is always 1
        'merchantIp' => '9.10.10.102',
        'password' => $password,
        'currency' => $currencycode,
        'requestHash' => $hash,
        'country' => "SA",
        "amount" => $amount,
        "currency" => "SAR",
        "country" => "SA",
        "instrumentType" => "Default",
        "sadadPaymentDetails" => [$sadatpay],
        "smsLanguage" => "ar",
        "sendLinkMode" => "2",
        "udf1" => "Recovery",
        "udf2" => route('sadadResponse'),
        "udf3" => $claim->id,
    );
    //   return $fields;
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://payments-dev.urway-tech.com/PGServiceB2B/transaction/jsonProcess/JSONrequest',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($fields),
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    ]);

    $response = curl_exec($curl);
    curl_close($curl);
    //return $response;
    $result = json_decode($response);
    if ($result->responseCode == 5005) {

        $sadad = new SadadPay();
        $sadad->claim_id = $claim->id;
        $sadad->tranid = $result->tranid;
        $sadad->trackid = $result->trackid;
        $sadad->amount = $result->amount;
        $sadad->sadadNumber = $result->sadadNumber;
        $sadad->hashResponse = $result->responseHash;
        $sadad->billNumber = $result->billNumber;
        $sadad->save();

        $delay = PayDelay::where('id', $delayId)->first();
        $delay->status = 2;
        $delay->link = $result->sadadNumber;
        $delay->pay_id = $result->billNumber;
        $delay->save();

        $claimid = "902";
        $amt = $amount;
        $sada = $result->sadadNumber;
        $message = "عزيزي العميل تم اصدار فاتورة سداد بمبلغ قدره" . $amt . " ريال سعودي بالرقم المرجعي" . $sada . " برجاء دفع الفاتورة من خلال الخيار" . $claimid .

            "شكرا وتحياتي";

        $response = Http::post('https://www.msegat.com/gw/sendsms.php', [
            "userName" => "Taheiya",
            "numbers" => $reciever,
            "userSender" => "Taheiya",
            "apiKey" => env('MSEGAT_API_KEY'),
            "msg" => $message
        ]);
        $data = json_decode($response->getBody(), true);

        if ($data['code'] == 1) {
            $smsres = new SmsResponse;
            $smsres->claim_id = $id;
            $smsres->code = $data['code'];
            $smsres->phone_no = $reciever;
            $smsres->message = $data['message'];
            $smsres->sms = $message;
            $smsres->save();
        } else {
            return "604";
        }

        return $result->sadadNumber;
    } else {
        return "504";
    }
}

function getRemarkRemainder()
{
    $date = Carbon::now()->format('Y-m-d H:i');
    $date = date('d-m-y', strtotime($date));
    // dd($date);
    $remainder = ClaimRemark::where('user_id', Auth::user()->id)->whereDate('remainder', $date)->get();
    return $remainder;
}

/**********************************
 * 30-07-2023
 * following helpers methods add by Muhammad Amir (pkfan)
 */

function settings($name = null)
{
    $settings = Settings::query();

    if (!$name) {
        return $settings;
    }

    $settingsCollection = $settings->get();

    $setting = $settingsCollection->firstWhere('name', $name)['value'] ?? null;

    return $setting;
}

function getUserIdByName($name)
{
    $username = User::where('name', $name)->first();
    if ($username != null) {

        return $username->id;
    } else {
        return '0';
    }
}


// function recoverTargets($user_id)
// {
//     $claims = Claim::where('is_assign', 70)->get();
//     // dd($claims);
//     $totalAmount = 0;
//     $recoverAmount = 0;

//     for ($i = 0; $i < $claims->count(); $i++) {

//         $totalAmount += $claims[$i]->amount_after_discount;

//         $payment = Payment::where('claim_id', $claims[$i]->id)
//             ->where('response_code', 000)
//             ->sum('amount');

//         $recoverAmount += $payment;

//         $sadadPayment = SadadResponse::where('claimid', $claims[$i]->id)
//             ->where('responseCode', 000)
//             ->sum('amount');

//         $recoverAmount += $sadadPayment;

//         $partialManual = PartialManual::where('claim_id', $claims[$i]->id)
//             ->sum('amount');

//         $recoverAmount += $partialManual;
//     }

//     // $officerTargets = OfficerTarget::firstWhere('officer_id', auth()->user()->id);


//     // $total = $officerTargets->total;
//     $acheivedPercentage = ($recoverAmount / $totalAmount)*100;

//     return [
//         'totalAmount'=>$totalAmount,
//         'recoverAmount' => number_format($recoverAmount, 2),
//         'acheivedPercentage' => number_format($acheivedPercentage, 2),
//     ];
// }


function recoverTargets()
{
    if (HelperFunctionsCache::$recoverTargets) {
        return HelperFunctionsCache::$recoverTargets;
    }

    // $year = now()->year;
    // $month = now()->month;
    // $day = now()->day;

    // $currentDate = "{$year}-{$month}-{$day}";

    // $officerTarget = OfficerTarget::where('officer_id', auth()->user()->id)
    //     ->where('start_date','<=',$currentDate)
    //     ->where('end_date','>=',$currentDate)
    //     ->first();

    $officerTarget = OfficerTarget::where('officer_id', auth()->user()->id)
        ->where('status', OfficerTargetStatus::ACTIVE->value)
        ->first();



    HelperFunctionsCache::$recoverTargets = $officerTarget;

    return HelperFunctionsCache::$recoverTargets;
}

function customCall($phone, $play)
{
    $reciever = array($phone);
    $refernce_id = rand(1, 10000000) . time();


    $ivrdetail = array(

        "recipient" => $reciever,
        "type" => "ivr",
        "callerId" => "+966115219815",
        "referenceId" => $refernce_id,
        "ivr" => array(
            "play" => $play,
            "responseUrl" => "https://unifonic2.requestcatcher.com/",
            "onEmptyResponse" => "We did not receive your response. Good bye.",
            "loop" => "1",
            "digitsLimit" => "1"
        ),

    );

    // dd(json_encode($card));
    //  $phone=json_encode($reciever);
    //  dd($phone);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://voice.unifonic.com/v1/calls',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($ivrdetail),
        CURLOPT_HTTPHEADER => array(
            'AppsId: lmfuLlmvVEKcOCMyxF1A',
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    //dd('ewe'.$response);
    return $response;
}

function hasDocumentCompelete($id)
{
    $result = DB::table('legal_department_model')->where('claim_id',$id)->first();
    return $result?->status;
}
