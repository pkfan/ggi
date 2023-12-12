<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Claim;
use App\Models\Reason;
use App\Models\FileBin;
use App\Models\Message;
use App\Models\PayDelay;
use App\Models\PreClaim;
use App\Models\ElmStatus;
use App\Models\CallStatus;
use App\Models\PartialPay;
use PhpParser\Comment\Doc;
use App\Models\ClaimReason;
use App\Models\ClaimRemark;
use App\Models\ClaimStatus;
use App\Models\FinanceCase;
use App\Models\LawFirmCase;
use App\Models\ClaimComment;
use App\Models\Distribution;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Supported_Doc;
use App\Models\CollectedClaim;
use App\Models\DebtorResponse;
use App\Models\TransferMorror;
use Illuminate\Support\Carbon;
use App\Models\DebtorRefuseReason;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Box\Spout\Reader\Common\Entity\Options;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use SoapClient;

class ClaimController extends Controller
{
    public function viewClaims() {

        if (Auth::user()->is_super == 1) {
            $claims = Claim::select('id', 'company_id', 'cid', 'claim_no', 'deb_mob', 'deb_name', 'type', 'rec_amt', 'acc_date', 'created_at', 'status', 'deb_type', 'acc_location', 'deb_name', 'deb_iqama')->get();
            return view('admin.view_claims', compact('claims'));
        } else {
            $claims = Claim::select('id', 'company_id', 'cid', 'claim_no', 'deb_mob', 'deb_name', 'type', 'rec_amt', 'acc_date', 'created_at', 'status', 'deb_type', 'acc_location', 'deb_name', 'deb_iqama')->get();
            return view('admin.view_claims', compact('claims'));
        }
    }

    public function rejectClaims() {

        if (Auth::user()->company_id != null) {
            $claims = Claim::where('status', 2)->where('company_id', Auth::user()->company_id)->paginate(10);
            // $claims=Claim::where('status',2)->where('company_id',Auth::user()->company_id)->get();
            return view('admin.reject_claim', compact('claims'));
        } else {
            if (Auth::user()->is_super == 1) {
                // $claims=Claim::where('status',2)->get();
                $claims = Claim::where('status', 2)->paginate(10);
                return view('admin.reject_claim', compact('claims'));
            } else {
                $claims = Claim::where('status', 2)->where('is_assign', Auth::user()->id)->paginate(10);
                // $claims=Claim::where('status',2)->where('is_assign',Auth::user()->id)->get();
            //    return $claims;
                return view('admin.reject_claim', compact('claims'));
            }
        }
    }

    public function adminApprovedClaims() {
        if (Auth::user()->company_id != null) {

            // $claims=Claim::where('status',1)->where('company_id',Auth::user()->company_id)->get();
            $claims = Claim::where('status', 1)->where('company_id', Auth::user()->company_id)->paginate(10);
            return view('admin.approved_claim', compact('claims'));
        } else {
            if (Auth::user()->is_super == 1) {
                // $claims=Claim::where('status',1)->get();
                $claims = Claim::where('status', 1)->paginate(10);
                return view('admin.approved_claim', compact('claims'));
            } else {
                // $claims=Claim::where('status',1)->where('is_assign',Auth::user()->id)->get();
                $claims = Claim::where('status', 1)->where('is_assign', Auth::user()->id)->paginate(10);
                return view('admin.approved_claim', compact('claims'));
            }
        }
    }

    // Toogle Claim Status
    public function toogleClaimStatus(Request $req)
    {
        // dd(phpinfo());
        $claim = Claim::where('id', $req->id)->first();
        if ($claim->status == 0) {
            // $claim->status=1;
            // $claim->save();
            // session()->put('success','Claim Status Changed');
            // return redirect()->route('AdminViewClaims');
            $uniqueCode = rand('10000', '99999') . 'art' . rand('10000', '99999');
            $link = $req->getSchemeAndHttpHost() . '/bit.ly/' . $uniqueCode;
            // $claim->status=1;
            $claim->link = $uniqueCode;
            $claim->link_count = 0;
            $claim->call_count += 1;
            $claim->save();
            approveDate($claim->id);
            $c = Claim::where('id', $req->id)->first();
            $getrecieverNumber = User::where('id', $c->cid)->first();
            $companyname = 'Al Rajhi Takaful';
            $recieverNumber = $c->deb_mob;
            if ($recieverNumber != null) {
                $message1 = "Dear Customer, kindly be informed that you have payment dues on " . $companyname . "Reference number RC" . $c->id . " amounting " . $c->amount_after_discount . ", for more information
            please visit the following link " . $link . "
            Remember, TAHEIYA won’t ask for any verification codes or passwords";
                //  $message2="} تذكر دائماً أن تهيئة لن تطلب أي أرقام سرية خاصة بكم بأي حال من الأحوال{$link}} لمزيد من المعلومات يرجى الاطلاع على المستندات من خلال الرابط {{$c->amount_after_discount}} بمبلغ وقدره {{$c->claim_no}عزيزي العميل، نفيدكم بوجود مطالبة مالية لدى شركة{";
                //    $companyname=getCompanyById($claim->company_id)->name;
                $companyname = 'GGI';
             $message2 =
                   'عزيزي العميل، نفيدكم بوجود مطالبة مالية لدى  '.$companyname.'رقم المرجع '.$claim->claim_no.'بمبلغ وقدره '.$claim->rec_amt.'ريال سعودي, لمزيد من المعلومات يرجى الاطلاع على المستندات من خلال الرابط '.$link.' ، تذكر دائماً أن الخليجية العامة  لن تطلب أي أرقام سرية خاصة بكم بأي حال من الأحوال'
                ;// adminSendMessage($recieverNumber,$message1);
                adminSendMessage($recieverNumber, $message2, $claim->id);
                try {
                    $claim->status = 1;
                    $claim->save();
                //   $response = json_decode(customCall($recieverNumber,''));
                //     // dd( $response);
                //     //  dd($response->callId,$response->referenceId);
                //     $callexit = CallStatus::where('claim_id', $claim->id)->count();
                //     if ($callexit > 0) {
                //         $callexit->claim_id = $claim->id;
                //         $callexit->callId = $response->callId;
                //         $callexit->referenceId = $response->referenceId;
                //         $callexit->save();
                //         $claim->save();
                //         session()->put('success', 'Claim Status Changed');
                //         return redirect()->route('AdminViewClaims');
                //     } else {
                //         $callexit1 = new CallStatus();
                //         $callexit1->claim_id = $claim->id;
                //         $callexit1->callId = $response->callId;
                //         $callexit1->referenceId = $response->referenceId;
                //         $callexit1->save();
                //         $claim->save();
                        return back()->with('success', 'Claim Status Changed');
                        // return redirect()->route('AdminViewClaims');
                //     }
                } catch (\Exception $e) {
                    // dd($e);
                    return back()->with('error', 'Fail can not call');
                    // return redirect()->route('AdminViewClaims');
                }
                // session()->put('success','Claim Approved');
                // return redirect()->route('AdminViewClaims');
                // }else{
                //      session()->put('success','Claim Approved');
                // return redirect()->route('AdminViewClaims');
                // }
            } else {
                try{
                    $wsdl           = 'https://api.absher.sa/AbsherSmsNotification?wsdl';
                    $endpoint       = 'https://api.absher.sa/AbsherSmsNotification';
                    $certificate    = './taheiyas.pem';
                    $password       = 'Taheiya@123$';
                    $options = array(
                        'location'      => $endpoint,
                        'keep_alive'    => true,
                        'trace'         => true,
                        'local_cert'    => $certificate,
                        'passphrase'    => $password,
                        'cache_wsdl'    => WSDL_CACHE_NONE,
                    );
                    $llog=(object)
                    array (
                      'ClientId' => '7026274915',
                      'ClientAuthorization' => 'hMrMOv3e70EUI87/G/kVAo/PtmKljsS3/0mi+gpEoNM=',
                      'TemplateId' => 'TAHEIYA-TMPL-02',
                      'Recipients' =>
                      array (
                        'Recipient' =>
                        array (
                          'NationalOrIqamaId' => $claim->deb_iqama,
                          'Language' => 'AR',
                          'Params' =>
                          array (
                            'Param' =>
                            array (
                              0 =>
                              array (
                                'Name' => 'VAR01',
                                'Value' => 'GGI',
                              ),
                              1 =>
                              array (
                                'Name' => 'VAR02',
                                'Value' =>  $claim->id ,
                              ),
                              2 =>
                              array (
                                'Name' => 'VAR03',
                                'Value' => $claim->rec_amt,
                              ),
                              3 =>
                              array (
                                'Name' => 'VAR04',
                                'Value' => 'www.ggi.taheiya.com.sa/'.'/bit.ly/'.$uniqueCode,
                              ),
                            ),
                          ),
                        ),
                      ),
                    );
                try{
                    // dd($options,$wsdl);
                    $claim->status=1;
                    $soapClient = new \SoapClient($wsdl, $options);
                    $response=$soapClient ->SubmitRequest($llog);
                    dd($response);
                        $elm = new ElmStatus;
                        $elm->claim_id=$claim->id;
                        $elm->batch_no= $response->BatchNumber;
                        $elm->status= $response->Status;
                        $elm->iqama='';
                        $elm->sms_description='';
                        $elm->save();
                        $claim->save();
                        // createNotification($claim->id,Auth::user()->id,'super admin','Admin Approve the claim RC00'.$claim->id);
                    session()->put('success','Claim Status Changed');
                    return redirect()->route('AdminViewClaims');
             } catch(SoapFault $fault) {
                dd($fault);
                 session()->put('fail','Something went wrong');
              //  return redirect()->route('AdminViewClaims');
                // trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
             }
                session()->put('success','Claim Approved');
                return redirect()->route('AdminViewClaims');
                }catch(\Exception $e){
                   dd($e);
                     session()->put('danger','Fail to not send sms');
                   /// return redirect()->route('AdminViewClaims');
                }
            }
        }
    }

    public function claimDetail($id)
    {
        // dd($id);
        $claim = Claim::where('id', $id)->first();
        //  dd($claim);
        return view('admin.view_claims.view_claim_detail', compact('claim'));
    }

     //edit claim
     public function editclaim($id)
     {
         $claim = Claim::where('id', $id)->first();
         return view('admin.view_claims.editclaims', compact('claim'));
     }

     public function resubmitclaim(Request $req)
     {

         $claim = Claim::where('id', $req->id)->first();

         $claim->amount_after_discount = $req->amount_after_discount;
         $claim->deb_iqama = $req->deb_iqama;
         if (!empty($req->acc_date)) {
             $claim->acc_date = $req->acc_date;
         } else {
             $claim->acc_date = $claim->acc_date;
         }

         $claim->acc_location = $req->acc_location;
         $claim->deb_name = $req->deb_name;
         $claim->deb_age = $req->deb_age;
         $claim->deb_mob = '+966' . $req->deb_mob;
         $claim->claim_no = $req->claim_no;
         $claim->ic_mail = $req->icmail;
         $claim->status = 0;
         if ($req->deb_type == 'insured') {
             $claim->deb_type = 'insured';
             $claim->rec_reason = $req->rec_reason;
         } elseif ($req->deb_type == 'third party') {
             $claim->deb_type = 'third party';
             $claim->rec_reason = "";
         }

         $claim->save();
         if ($req->hasfile('support_doc')) {

             $documents = Supported_Doc::where('claim_id', $req->id)->get();
             foreach ($documents as $doc) {
                 File::delete(storage_path . '/app/public/' . ($doc->doc_name));
                 $doc->delete();
             }


             foreach ($req->file('support_doc') as $file) {

                 $doc = new Supported_Doc;
                 $doc->company_id = $claim->cid;
                 $ran = rand(3, 9999);
                 $name = time() . $ran . '.' . $file->getClientOriginalExtension();
                 $filepath = 'claims/' . $claim->id . '/company/' . $claim->cid . '/Supported_document/';
                 $file->move(storage_path() . '/app/public/' . $filepath, $name);
                 $doc->doc_name = $filepath . $name;
                 $doc->claim_id = $claim->id;
                 $doc->save();
             }
         }

         if (empty($claim->link)) {
             return back()->with('success', 'Request Details Changed Successfully');
         } else {
             $uniqueCode = rand('10000', '99999') . 'taheiya' . rand('10000', '99999');
             $link = $req->getSchemeAndHttpHost() . '/bit.ly/' . $uniqueCode;


             $claim->status = 1;
             $claim->link = $uniqueCode;
             $claim->link_count = 0;
             $claim->call_count += 1;

             $claim->save();

             $c = Claim::where('id', $req->id)->first();
             $getrecieverNumber = User::where('id', $c->cid)->first();


             $recieverNumber = $c->deb_mob;

             if ($recieverNumber != null) {
                 $message1 = " Dear Customer, kindly be informed that your objection on claim number" . $c->claim_no . "for the company" . companyname($c->id) . "has been accepted , therefore, you have to pay the amount of" . $c->amount_after_discount . "in order to close the claim file
                please visit the following link " . $link . "
                Remember, TAHEIYA won’t ask for any verification codes or passwords";

                 //    $companyname=getCompanyById($claim->company_id)->name;
                 $companyname = 'Al Rajhi Takaful';
                 $message2 = "عزيزي العميل نفيدكم بأن اعتراضكم على المطالبة رقم" . $c->id . "لدى الشركة" . $companyname . "تم قبوله ، عليه يرجى سداد مبلغ" . $c->amount_after_discount . " لمزيد من المعلومات يرجى الاطلاع على المستندات من خلال الرابط" . $link . " ، تذكر دائماً أن تهيئة لن تطلب أي أرقام سرية خاصة بكم بأي حال من الأحوال";
                 // adminSendMessage($recieverNumber,$message1);
                 adminSendMessage($recieverNumber, $message2, $claim->id);


                 $debtoresponse = DebtorResponse::where('claim_id', $claim->id)->first();
                 //dd($debtoresponse);
                 $debtoresponse->delete();
                 return back()->with('success', 'Request Details Changed Successfully');
             } else {
                 try {

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


                     $llog = (object)
                     array(
                         'ClientId' => '7026274915',
                         'ClientAuthorization' => 'hMrMOv3e70EUI87/G/kVAo/PtmKljsS3/0mi+gpEoNM=',
                         'TemplateId' => 'TAHEIYA-TMPL-02',
                         'Recipients' =>
                         array(
                             'Recipient' =>
                             array(
                                 'NationalOrIqamaId' => $claim->deb_iqama,
                                 'Language' => 'AR',
                                 'Params' =>
                                 array(
                                     'Param' =>
                                     array(
                                         0 =>
                                         array(
                                             'Name' => 'VAR01',
                                             'Value' => getCompanyById($claim->company_id)->name,
                                         ),
                                         1 =>
                                         array(
                                             'Name' => 'VAR02',
                                             'Value' =>  $claim->id,
                                         ),
                                         2 =>
                                         array(
                                             'Name' => 'VAR03',
                                             'Value' => $claim->amount_after_discount,
                                         ),
                                         3 =>
                                         array(
                                             'Name' => 'VAR04',
                                             'Value' => 'www.recovery.taheiya.sa/' . '/bit.ly/' . $uniqueCode,
                                         ),
                                     ),
                                 ),
                             ),
                         ),

                     );

                     try {
                         $claim->status = 1;
                         $soapClient = new \SoapClient($wsdl, $options);

                         $response = $soapClient->SubmitRequest($llog);

                         $elm = new ElmStatus;
                         $elm->claim_id = $claim->id;
                         $elm->batch_no = $response->BatchNumber;
                         $elm->status = $response->Status;
                         $elm->save();
                         $claim->save();
                         $debtoresponse = DebtorResponse::where('claim_id', $claim->id)->first();
                         //dd($debtoresponse);
                         $debtoresponse->delete();
                         session()->put('success', 'Claim Status Changed');
                         return redirect()->route('AdminViewClaims');
                     } catch (SoapFault $fault) {
                         session()->put('fail', 'Something went wrong');
                         return redirect()->route('AdminViewClaims');
                         // trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);

                     }
                     session()->put('success', 'Claim Approved');
                     return redirect()->route('AdminViewClaims');
                 } catch (\Exception $e) {
                     // dd($e);
                     session()->put('danger', 'Fail to not send sms');
                     return redirect()->route('AdminViewClaims');
                 }
             }
         }
     }

     ///reject and rejection reason
    public function rejectClaim(Request $req)
    {

        // dd($req->id);
        try {
            $claim = Claim::where('id', $req->id)->first();

            $claim->rejection_reason = $req->rejection_reason;
            $claim->status = 2;
            $email = $claim->ic_mail;

            $claim->save();

            $message = new Message;
            $message->sender_id = Auth::user()->id;
            $message->receiver_id = $claim->cid;
            $message->description = $claim->rejection_reason;
            $message->claim_id = $claim->id;

            $details = [
                'claimId' => $claim->id,

            ];
            $message->save();
            \Mail::to($email)->send(new \App\Mail\ClaimRejectMail($details));
            return back()->with('success', 'Successfully Rejected');
            DB::commit();
        } catch (\Exception $e) {
            //dd('dsd');
            dd($e);
            DB::rollback();
            return back()->with('error', 'Mail not sent');
        }
    }

    public function removeClaimFile($claimid, $file) {
        $preclaim = PreClaim::where('claim_id', $claimid)->where('status', 2)->first();


        $document = json_decode($preclaim->document);
        // dd($document,addslash($file));
        for ($i = 0; $i < sizeof($document); $i++) {
            if ($document[$i] == addslash($file)) {
                $document[$i] = '';
            }
        }
        $doc = json_encode($document);
        $preclaim->document = $doc;
        $preclaim->save();
        return back()->with('success', 'File Removed Successfully');
    }

    public function removeFileClaim($claimno, $file) {

        $preclaim = PreClaim::where('claim_no', $claimno)->where('status', 1)->first();


        $document = json_decode($preclaim->document);
        // dd($document,addslash($file));
        for ($i = 0; $i < sizeof($document); $i++) {
            if ($document[$i] == addslash($file)) {
                $document[$i] = '';
            }
        }
        $doc = json_encode($document);
        $preclaim->document = $doc;
        $preclaim->save();
        return back()->with('success', 'File Removed Successfully');
    }

    public function removeSupportiveDoc($id, $file) {
        $file = addslash($file);
        $doc = Supported_Doc::where('doc_name', $file)->first();
        unlink(public_path() . '/' . $file);
        $doc->delete();
        return back()->with('success', 'Document Remove Successfully');
    }

    public function getclaim($id)
    {

        $claim = Claim::where('id', $id)->first();

        return view('admin.detailclaim', compact('claim'));
    }

    public function approve(Request $req)
    {

        if ($req->row == null) {
            return back()->with('error', 'Please Select Row');
        } else {
            foreach ($req->row as $row) {
                $claim = Claim::where('id', $row)->first();
                $claim->status = 1;
                $claim->save();
            }
            return back()->with('success', 'All Selected Claims Approved');
        }
    }
    public function icPreclaimView() {
        if (Auth::user()->company_id != null) {
            $files = PreClaim::where('company_id', Auth::user()->company_id)->get();
            return view('admin.preclaimReq', compact('files'));
        } else {
            $files = PreClaim::all();
            return view('admin.preclaimReq', compact('files'));
        }
    }

    public function addClaimView() {
        //  $debtor=User::where('roll',2)->get();
        $reason = Reason::all();
        return view('admin.addclaim', compact('reason'));
    }

    // commented by zeeshan sir
    // public function addClaim(Request $req)
    // {

    //     $req->validate([
    //         'deb_iqama' => 'min:10|max:10',
    //     ]);
    //     DB::beginTransaction();

    //     try {
    //         $claim = new Claim;
    //         $claim1 = str_replace("/", "-", $req->claim_no);
    //         $company = Preclaim::where('claim_no', $claim1)->first();
    //         $company_id = $company->company_id;

    //         $claim->cid = Auth::user()->id;
    //         $claim->type = $req->type;
    //         $claim->libpercent = $req->libpercent;
    //         $claim->company_id = $company_id;
    //         $claim->amount_after_discount = $req->amount_after_discount;
    //         // $claim->deb_iqama=$req->deb_iqama;
    //         $claim->acc_date = $req->acc_date;
    //         $claim->acc_location = $req->acc_location;
    //         $claim->deb_name = $req->deb_name;
    //         $claim->ic_mail = $req->icemail;
    //         $claim->deb_age = $req->deb_age;
    //         $claim->claim_no = $req->claim_no;
    //         $claim->claim_type = $claim->claim_type;
    //         if ($claim->claim_type = "no") {
    //             $req->validate([
    //                 'deb_iqama' => 'min:10|max:10',
    //             ]);
    //             $claim->deb_iqama = $req->deb_iqama;
    //             if ($req->deb_mob != null) {
    //                 $claim->deb_mob = '+966' . $req->deb_mob;
    //             }
    //         }



    //         if ($req->deb_type == 'insured') {
    //             $claim->deb_type = 'insured';
    //             $claim->rec_reason = $req->rec_reason;
    //         } else {
    //             $claim->deb_type = 'third_party';
    //             $claim->rec_reason = "";
    //         }


    //         $claim->save();

    //         $admin = User::where('roll', 0)->first();
    //         Notification::create([
    //             'from' => Auth::user()->id,
    //             'to' => $admin->id,
    //             'message' => 'New Claim Added',
    //             'type' => 'claim added',
    //             'read' => false,
    //         ]);

    //         if ($req->hasfile('support_doc')) {

    //             foreach ($req->file('support_doc') as $file) {
    //                 $doc = new Supported_Doc;
    //                 $doc->company_id = $claim->cid;
    //                 $ran = rand(3, 9999);
    //                 $name = time() . $ran . '.' . $file->getClientOriginalExtension();
    //                 $filepath = 'claims/' . $claim->id . '/company/' . $claim->cid . '/Supported_document/';
    //                 $file->move(storage_path() . '/app/public/' . $filepath, $name);
    //                 $doc->doc_name = $filepath . $name;
    //                 $doc->claim_id = $claim->id;
    //                 $doc->save();
    //             }
    //         }
    //         $company->status = 2;
    //         $company->claim_id = $claim->id;
    //         $company->save();
    //         if ($req->doctype != null) {
    //             try {
    //                 $document = json_decode($company->document);
    //                 // dd($req->doctype);
    //                 // dd($document,addslash($file));
    //                 for ($i = 0; $i < sizeof($document); $i++) {
    //                     for ($a = 0; $a < sizeof($req->doctype); $a++) {
    //                         if ($document[$i] == $req->doctype[$a]) {
    //                             $filebin = new FileBin;

    //                             $filebin->file_id = $company->id;
    //                             $filebin->doc_name = json_encode($req->doctype[$a]);

    //                             $filebin->save();
    //                             $document[$i] = '';
    //                         }
    //                     }
    //                 }
    //                 $doc = json_encode($document);
    //                 $company->document = $doc;
    //                 $company->save();
    //             } catch (\Exception $e) {
    //                 return back()->with('error', 'Something went wrong');
    //             }
    //         }


    //         DB::commit();
    //         return back()->with('success', 'Claim Added Successfully');
    //     } catch (\Exception $e) {
    //         // dd($e);
    //         DB::rollback();
    //         return back()->with('error', 'Something went wrong');
    //     }


    //     // return back()->with('success','Your Claim Request Added SuccessFully');
    // }

    public function approvePreClaim($id) {
        $file = PreClaim::find($id);
        $file->status = 2;
        // $file->save();
        return redirect('admin/addclaim/' . $file->claim_no);
    }

    public function addPreComment(Request $req)
    {
        $claim = Preclaim::where('id', $req->claim_id)->first();
        $claim->comments = $req->comment;
        $claim->status = 3;
        $claim->save();
        return back()->with('success', 'Comment added successfully');
    }

    public function addClaimRemark(Request $req)
    {
        $req->validate([
            'remarks' => 'required'
        ]);

        $remark = new ClaimRemark;
        $remark->user_id = Auth::user()->id;
        $remark->claim_id = $req->claim_id;
        if ($req->rem_date != null) {
            $date = str_replace('T', ' ', $req->rem_date);
            $myd = Carbon::createFromFormat('Y-m-d H:i:s', $date . ':00')->format('d-m-y');
            $his = Carbon::createFromFormat('Y-m-d H:i:s', $date . ':00')->format('h:i:s');
            $fulldate = $myd . ' ' . $his;
            $remark->remainder = $fulldate;
        }
        $remark->remark = $req->remarks;
        $remark->add_remark = $req->addremark;
        $remark->save();

        $count = ClaimStatus::where('claim_id', $remark->claim_id)->count();
        if ($count == 0) {
            $claimstatus = new ClaimStatus;
            $claimstatus->claim_id = $remark->claim_id;
            $claimstatus->status = 1;
            $claimstatus->update_by = Auth::user()->id;
            $claimstatus->save();
            statusHistory($claimstatus->claim_id, 1, Auth::user()->id);
        }

        return back()->with('success', 'Remark added successfully');
    }

    public function viewRemarks($id) {
        $remarks = ClaimRemark::where('claim_id', $id)->get();
        return view('admin.claimremark', compact('remarks'));
    }

    public function distributeClaims() {
        return distribution();
    }

    public function assignedClaim() {
        $dis = Distribution::orderBy('id', 'DESC')->get();
        return view('admin.assignedclaim', compact('dis'));
    }

    public function reassClaim(Request $req)
    {
        $req->validate([
            'id' => 'required',
            'adminid' => 'required'
        ]);
        try {
            $claimid = $req->id;
            $claim = Claim::where('id', $claimid)->first();
            $distribute = Distribution::where('claim_id', $claimid)->first();
            //dd($req->adminid);
            $claim->is_assign = $req->adminid;
            $distribute->user_id = $req->adminid;
            $claim->save();
            $distribute->save();
            return back()->with('success', 'Claim Re-assigned Successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function editClaimView($id) {
        $claim = Claim::with('claimData','supportedDocs','officer')->where('id', $id)->first();
        return view('admin.editclaim', compact('claim'));
    }

    public function editclaiminfo(Request $req)
    {

        // $req->validate([
        //   'deb_mob'=>'min:9|max:9',
        // ]);

        $claim = Claim::where('id', $req->id)->first();
        $claim->amount_after_discount = $req->amount_after_discount;
        $claim->deb_iqama = $req->deb_iqama;
        if (!empty($req->acc_date)) {
            $claim->acc_date = $req->acc_date;
        } else {
            $claim->acc_date = $claim->acc_date;
        }

        $claim->acc_location = $req->acc_location;
        $claim->deb_name = $req->deb_name;
        $claim->deb_age = $req->deb_age;
        $claim->ic_mail = $req->icmail;
        $claim->our_responsipility_per;
        //  if($claim->deb_mob!=null){
        $claim->deb_mob = '+966' . $req->deb_mob;
        //   }
        $claim->claim_no = $req->claim_no;

        if ($req->deb_type == 'insured') {
            $claim->deb_type = 'issured';
            $claim->rec_reason = $req->rec_reason;
        } elseif ($req->deb_type == 'third party') {
            $claim->deb_type = 'third party';
            $claim->rec_reason = "";
        }

        $claim->save();
        if ($req->hasfile('support_doc')) {

            //   $documents=Supported_Doc::where('claim_id',$req->id)->get();
            //   foreach($documents as $doc){
            //       File::delete(storage_path($doc->doc_name));
            //       $doc->delete();
            //     }


            foreach ($req->file('support_doc') as $file) {
                $doc = new Supported_Doc;
                $doc->company_id = $claim->company_id;
                $ran = rand(3, 9999);
                $name = time() . $ran . '.' . $file->getClientOriginalExtension();
                $filepath = 'claims/' . $claim->id . '/company/' . $claim->cid . '/Supported_document/';
                $file->move(storage_path() . '/app/public/' . $filepath, $name);
                $doc->doc_name = $filepath . $name;
                $doc->claim_id = $claim->id;
                $doc->save();
            }
        }

        if ($req->prefile != null) {
            $company = PreClaim::where('claim_id', $req->id)->first();
            try {
                $document = json_decode($company->document);
                // // dd($req->doctype);
                // // dd($document,addslash($file));
                for ($i = 0; $i < sizeof($document); $i++) {
                    for ($a = 0; $a < sizeof($req->prefile); $a++) {
                        if ($document[$i] == $req->prefile[$a]) {
                            $filebin = new FileBin();

                            $filebin->file_id = $company->id;
                            $filebin->doc_name = json_encode(
                                $req->prefile[$a]
                            );

                            $filebin->save();
                            $document[$i] = '';
                        }
                    }
                }
                $doc = json_encode($document);
                $company->document = $doc;
                $company->save();
            } catch (\Exception $e) {
                return back()->with('error', 'Something went wrong');
            }
        }

        if ($req->doctype != null) {
            try {

                for ($i = 0; $i < sizeof($req->doctype); $i++) {
                    $doc = Supported_Doc::where('doc_name', $req->doctype[$i])->first();
                    $doc->delete();
                }
            } catch (\Exception $e) {
                return back()->with('error', 'Something went wrong');
            }
        }


        return back()->with('success', ' Successfully updated');
    }

    public function claimCollected(Request $req)
    {

        DB::beginTransaction();
        try {


            $count = ClaimStatus::where('claim_id', $req->claimid)->count();
            $claimstatus = ClaimStatus::where('claim_id', $req->claimid)->first();
            $claim = Claim::where('id', $req->claimid)->first();
            if ($count == 0) {
                $claimstatus = new ClaimStatus();
                $claimstatus->claim_id = $req->claimid;
                $claimstatus->status = 2;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 2, Auth::user()->id);
            } else {
                $claimstatus->status = 2;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 2, Auth::user()->id);
            }
            if ($req->cash == 'yes') {

                $collected = new CollectedClaim;
                $collected->claim_id = $req->claimid;
                $collected->update_by = Auth::user()->id;
                $collected->payment = 'cash';
                $collected->save();

                $claim->status = 3;
                $claim->save();
                // $comment=ClaimComment::where('claim_id',$req->claimid)->get();
                // $comment->each->delete();

                $paydelay = PayDelay::where('claim_id', $req->claimid)->get();
                if ($paydelay) {
                    PayDelay::where('claim_id', $req->claimid)
                        ->update(['status' => 5]);
                }

                $partial = PartialPay::where('claim_id', $req->claimid)->get();
                if ($partial) {
                    PartialPay::where('claim_id', $req->claimid)->where('status', 2)
                        ->update(['status' => 6]);
                    PartialPay::where('claim_id', $req->claimid)->where('status', 1)
                        ->update(['status' => 5]);
                    //$partial->each->delete();
                }
                $debrefuse = DebtorRefuseReason::where('claim_id', $req->claimid)->get();
                if ($debrefuse) {
                    // $debrefuse->each->delete();
                    DebtorRefuseReason::where('claim_id', $req->claimid)
                        ->update(['status' => 5]);
                }
                $debresp = DebtorResponse::where('claim_id', $req->claimid)->get();
                if ($debresp) {
                    // $debresp->each->delete();
                    DebtorResponse::where('claim_id', $req->claimid)
                        ->update(['status' => 5]);
                }
                $morror = TransferMorror::where('claim_id', $req->claimid)->first();
                if ($morror) {
                    TransferMorror::where('claim_id', $req->claimid)
                        ->update(['status' => 2]);
                }

                $financcase = FinanceCase::where('claim_id', $req->claimid)->first();
                if ($financcase) {
                    $financcase->delete();
                }
                if ($req->statusreason != null) {
                    $reason = new ClaimReason;
                    $reason->claim_id = $req->claimid;
                    $reason->update_by = Auth::user()->id;
                    $reason->reason = $req->statusreason;
                    $reason->status = 2;
                    $reason->save();
                }
                DB::commit();
                return back()->with('success', 'Status Added Successfully');
            } else {
                $collected = new CollectedClaim;
                $collected->claim_id = $req->claimid;
                $collected->update_by = Auth::user()->id;
                $collected->payment = 'bank';
                $collected->save();
                $claim->status = 3;
                $claim->save();

                $paydelay = PayDelay::where('claim_id', $req->claimid)->get();
                if ($paydelay) {
                    PayDelay::where('claim_id', $req->claimid)
                        ->update(['status' => 5]);
                }

                $partial = PartialPay::where('claim_id', $req->claimid)->get();
                if ($partial) {
                    PartialPay::where('claim_id', $req->claimid)
                        ->update(['status' => 5]);
                    //$partial->each->delete();
                }
                $debrefuse = DebtorRefuseReason::where('claim_id', $req->claimid)->get();
                if ($debrefuse) {
                    // $debrefuse->each->delete();
                    DebtorRefuseReason::where('claim_id', $req->claimid)
                        ->update(['status' => 5]);
                }
                $debresp = DebtorResponse::where('claim_id', $req->claimid)->get();
                if ($debresp) {
                    // $debresp->each->delete();
                    DebtorResponse::where('claim_id', $req->claimid)
                        ->update(['status' => 5]);
                }
                $morror = TransferMorror::where('claim_id', $req->claimid)->first();
                if ($morror) {
                    TransferMorror::where('claim_id', $req->claimid)
                        ->update(['status' => 2]);
                }

                $financcase = FinanceCase::where('claim_id', $req->claimid)->first();
                if ($financcase) {
                    $financcase->delete();
                }
                $firm = LawFirmCase::where('claim_id', $req->claimid)->first();
                if ($firm) {
                    $firm->delete();
                }

                if ($req->statusreason != null) {
                    $reason = new ClaimReason;
                    $reason->claim_id = $req->claimid;
                    $reason->update_by = Auth::user()->id;
                    $reason->reason = $req->statusreason;
                    $reason->status = 2;
                    $reason->save();
                }

                DB::commit();
                return back()->with('success', 'Status Added Successfully');
            }
        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();
            return back()->with('error', 'Something went wrong');
        }
    }

    public function collectedByIc(Request $req)
    {
        DB::beginTransaction();
        try {


            $count = ClaimStatus::where('claim_id', $req->claimid)->count();
            $claimstatus = ClaimStatus::where('claim_id', $req->claimid)->first();

            if ($count == 0) {
                $claimstatus = new ClaimStatus();
                $claimstatus->claim_id = $req->claimid;
                $claimstatus->status = 11;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 11, Auth::user()->id);
            } else {
                $claimstatus->status = 11;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 11, Auth::user()->id);
            }



            $paydelay = PayDelay::where('claim_id', $req->claimid)->get();
            if ($paydelay) {
                PayDelay::where('claim_id', $req->claimid)
                    ->update(['status' => 5]);
            }

            $partial = PartialPay::where('claim_id', $req->claimid)->get();
            if ($partial) {
                PartialPay::where('claim_id', $req->claimid)
                    ->update(['status' => 5]);
                //  $partial->each->delete();
            }
            $debrefuse = DebtorRefuseReason::where('claim_id', $req->claimid)->get();
            if ($debrefuse) {
                DebtorRefuseReason::where('claim_id', $req->claimid)
                    ->update(['status' => 5]);
                // $debrefuse->each->delete();
            }
            $debresp = DebtorResponse::where('claim_id', $req->claimid)->get();
            if ($debresp) {
                // $debresp->each->delete();
                DebtorResponse::where('claim_id', $req->claimid)
                    ->update(['status' => 5]);
            }
            $morror = TransferMorror::where('claim_id', $req->claimid)->first();
            if ($morror) {
                TransferMorror::where('claim_id', $req->claimid)
                    ->update(['status' => 2]);
            }

            $financcase = FinanceCase::where('claim_id', $req->claimid)->first();
            if ($financcase) {
                $financcase->delete();
            }

            $collected = CollectedClaim::where('claim_id', $req->claimid)->get();
            if ($collected) {
                // $collected->each->delete();
                CollectedClaim::where('claim_id', $req->claimid)
                    ->update(['status' => 5]);
            }
            $firm = LawFirmCase::where('claim_id', $req->claimid)->first();
            if ($firm) {
                $firm->delete();
            }
            if ($req->statusreason != null) {
                $reason = new ClaimReason;
                $reason->claim_id = $req->claimid;
                $reason->update_by = Auth::user()->id;
                $reason->reason = $req->statusreason;
                $reason->status = 11;
                $reason->save();
            }
            DB::commit();
            return back()->with('success', 'Status Added Successfully');
        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();
            return back()->with('error', 'Something went wrong');
        }
    }

    public function closeClaim(Request $req)
    {
        DB::beginTransaction();
        try {


            $count = ClaimStatus::where('claim_id', $req->claimid)->count();
            $claimstatus = ClaimStatus::where('claim_id', $req->claimid)->first();

            if ($count == 0) {
                $claimstatus = new ClaimStatus();
                $claimstatus->claim_id = $req->claimid;
                $claimstatus->status = 10;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 10, Auth::user()->id);
            } else {
                $claimstatus->status = 10;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 10, Auth::user()->id);
            }
            if ($req->elm == 'yes') {

                $claim = Claim::where('id', $req->claimid)->first();
                $claim->status = 4;
                $claim->save();

                $paydelay = PayDelay::where('claim_id', $req->claimid)->get();
                if ($paydelay) {
                    PayDelay::where('claim_id', $req->claimid)
                        ->update(['status' => 5]);
                }

                $partial = PartialPay::where('claim_id', $req->claimid)->get();
                if ($partial) {
                    PartialPay::where('claim_id', $req->claimid)
                        ->update(['status' => 5]);
                    //  $partial->each->delete();
                }
                $debrefuse = DebtorRefuseReason::where('claim_id', $req->claimid)->get();
                if ($debrefuse) {
                    DebtorRefuseReason::where('claim_id', $req->claimid)
                        ->update(['status' => 5]);
                    // $debrefuse->each->delete();
                }
                $debresp = DebtorResponse::where('claim_id', $req->claimid)->get();
                if ($debresp) {
                    // $debresp->each->delete();
                    DebtorResponse::where('claim_id', $req->claimid)
                        ->update(['status' => 5]);
                }
                $morror = TransferMorror::where('claim_id', $req->claimid)->first();
                if ($morror) {
                    TransferMorror::where('claim_id', $req->claimid)
                        ->update(['status' => 2]);
                }

                $financcase = FinanceCase::where('claim_id', $req->claimid)->first();
                if ($financcase) {
                    $financcase->delete();
                }

                $collected = CollectedClaim::where('claim_id', $req->claimid)->get();
                if ($collected) {
                    // $collected->each->delete();
                    CollectedClaim::where('claim_id', $req->claimid)
                        ->update(['status' => 5]);
                }
                $firm = LawFirmCase::where('claim_id', $req->claimid)->first();
                if ($firm) {
                    $firm->delete();
                }

                DB::commit();
                if ($req->statusreason != null) {
                    $reason = new ClaimReason;
                    $reason->claim_id = $req->claimid;
                    $reason->update_by = Auth::user()->id;
                    $reason->reason = $req->statusreason;
                    $reason->status = 10;
                    $reason->save();
                }
                return back()->with('success', 'Status Added Successfully');
            } else {
                return back()->with('success', 'Nothing Updated');
            }
        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();
            return back()->with('error', 'Something went wrong');
        }
    }

    public function claimComments($id) {
        $comments = ClaimComment::where('claim_id', $id)->select('comment', 'status', 'updated_at', 'update_by')->get();
        return view('admin.comments', compact('comments'));
    }

    public function  addClaimComment(Request $req)
    {

        if ($req->claimid != null) {
            DB::beginTransaction();
            try {
                $comment = new ClaimComment;
                $comment->claim_id = $req->claimid;
                $comment->ic_id = $req->company_id;
                $comment->update_by = Auth::user()->id;
                $comment->comment = $req->comments;
                $comment->status = 1; //status =1 admin comment status 2 ic comment
                $comment->save();
                DB::commit();
                return back()->with('success', 'Comment Added Successfully');
            } catch (\Exception $e) {
                dd($e);
                DB::rollback();
                return back()->with('error', 'Something went wrong');
            }
        } else {
            return back()->with('error', 'Select Claim First');
        }
    }

    public function claimCommentView() {
        $comments = ClaimComment::where('claim_id', 0)->select('comment', 'status', 'updated_at', 'update_by')->get();
        return view('admin.comments', compact('comments'));
    }


    private function searchAndFilterClaims($req, $claimQuery){
        if($req->idclaim!=null){
            return $claimQuery->where('id', $req->idclaim);
        }else if($req->claimStatus != null){
           
            if($req->claimStatus == 1){
                return $claimQuery->join('claim_status','claim_status.claim_id','=','claims.id')
                 ->join('claim_remarks','claim_status.claim_id','=','claim_remarks.claim_id')
                 ->where('claim_remarks.status',1)->whereNotNull('claim_remarks.remainder')
                 ->select('claims.id','claims.company_id','claims.cid','claims.claim_no','claims.deb_mob','claims.deb_name',
                 'claims.type','claims.rec_amt','claims.acc_date','claims.created_at','claims.status','claims.deb_type','claims.acc_location',
                 'claims.deb_name','claims.deb_iqama','claims.is_assign');
                 
                
             }else if($req->claimStatus == '12'){
                
                 return $claimQuery->join('claim_status','claim_status.claim_id','=','claims.id')->join('claim_remarks','claim_status.claim_id','=','claim_remarks.claim_id')
                 ->where('claim_remarks.status',1)->whereNull('claim_remarks.remainder')
                 ->where('claim_status.status',1)
                 ->select('claims.id','claims.company_id','claims.cid','claims.claim_no','claims.deb_mob','claims.deb_name',
                 'claims.type','claims.rec_amt','claims.acc_date','claims.created_at','claims.status','claims.deb_type','claims.acc_location',
                 'claims.deb_name','claims.deb_iqama','claims.is_assign')
                 ;
                 // dd($claims);
                 
             }
             
             else if($req->claimStatus == 2){
                 return $claimQuery->join('claim_status','claim_status.claim_id','=','claims.id')->where('claim_status.status',2)->select('claims.id','claims.company_id','claims.cid','claims.claim_no','claims.deb_mob','claims.deb_name',
                 'claims.type','claims.rec_amt','claims.acc_date','claims.created_at','claims.status','claims.deb_type','claims.acc_location',
                 'claims.deb_name','claims.deb_iqama','claims.is_assign')
                 ;
                  
             }
             else if($req->claimStatus == 3){
                 return $claimQuery->join('claim_status','claim_status.claim_id','=','claims.id')->where('claim_status.status',3)->select('claims.id','claims.company_id','claims.cid','claims.claim_no','claims.deb_mob','claims.deb_name',
                 'claims.type','claims.rec_amt','claims.acc_date','claims.created_at','claims.status','claims.deb_type','claims.acc_location',
                 'claims.deb_name','claims.deb_iqama','claims.is_assign')
                 ;
             }
             else if($req->claimStatus == 4){
                 return $claimQuery->join('claim_status','claim_status.claim_id','=','claims.id')->where('claim_status.status',4)->select('claims.id','claims.company_id','claims.cid','claims.claim_no','claims.deb_mob','claims.deb_name',
                 'claims.type','claims.rec_amt','claims.acc_date','claims.created_at','claims.status','claims.deb_type','claims.acc_location',
                 'claims.deb_name','claims.deb_iqama','claims.is_assign')
                 ;
             }else if($req->claimStatus == 5){
                 return $claimQuery->join('claim_status','claim_status.claim_id','=','claims.id')->where('claim_status.status',5)->select('claims.id','claims.company_id','claims.cid','claims.claim_no','claims.deb_mob','claims.deb_name',
                 'claims.type','claims.rec_amt','claims.acc_date','claims.created_at','claims.status','claims.deb_type','claims.acc_location',
                 'claims.deb_name','claims.deb_iqama','claims.is_assign')
                 ;
             }else if($req->claimStatus == 6){
                 return $claimQuery->join('claim_status','claim_status.claim_id','=','claims.id')->where('claim_status.status',6)->select('claims.id','claims.company_id','claims.cid','claims.claim_no','claims.deb_mob','claims.deb_name',
                 'claims.type','claims.rec_amt','claims.acc_date','claims.created_at','claims.status','claims.deb_type','claims.acc_location',
                 'claims.deb_name','claims.deb_iqama','claims.is_assign')
                 ;
             }else if($req->claimStatus == 7){
                 return $claimQuery->join('claim_status','claim_status.claim_id','=','claims.id')->where('claim_status.status',7)->select('claims.id','claims.company_id','claims.cid','claims.claim_no','claims.deb_mob','claims.deb_name',
                 'claims.type','claims.rec_amt','claims.acc_date','claims.created_at','claims.status','claims.deb_type','claims.acc_location',
                 'claims.deb_name','claims.deb_iqama','claims.is_assign')
                 ;
             }else if($req->claimStatus == 8){
                 return $claimQuery->join('claim_status','claim_status.claim_id','=','claims.id')->where('claim_status.status',8)->select('claims.id','claims.company_id','claims.cid','claims.claim_no','claims.deb_mob','claims.deb_name',
                 'claims.type','claims.rec_amt','claims.acc_date','claims.created_at','claims.status','claims.deb_type','claims.acc_location',
                 'claims.deb_name','claims.deb_iqama','claims.is_assign')
                 ;
             }else if($req->claimStatus == 9){
                 return $claimQuery->join('claim_status','claim_status.claim_id','=','claims.id')->where('claim_status.status',9)->select('claims.id','claims.company_id','claims.cid','claims.claim_no','claims.deb_mob','claims.deb_name',
                 'claims.type','claims.rec_amt','claims.acc_date','claims.created_at','claims.status','claims.deb_type','claims.acc_location',
                 'claims.deb_name','claims.deb_iqama','claims.is_assign')
                 ;
             }else if($req->claimStatus == 10){
                 return $claimQuery->join('claim_status','claim_status.claim_id','=','claims.id')->where('claim_status.status',10)->select('claims.id','claims.company_id','claims.cid','claims.claim_no','claims.deb_mob','claims.deb_name',
                 'claims.type','claims.rec_amt','claims.acc_date','claims.created_at','claims.status','claims.deb_type','claims.acc_location',
                 'claims.deb_name','claims.deb_iqama','claims.is_assign')
                 ;
             }else if($req->claimStatus == 'reg'){
               
                return $claimQuery->where('status',0);
                
             }
             else if($req->claimStatus =='app'){
                 
                return $claimQuery->where('status', 1)
                ->whereNotIn('id', function ($query) {
                    $query->select('claim_id')
                        ->from('claim_status');
                });
             }
             else if($req->claimStatus == 'rejec'){
                  return $claimQuery->where('status',2);
             }
        }
        else if($req->debname!=null){
            return $claimQuery->where('deb_name','like','%'.$req->debname.'%');
        }else if($req->claimno!=null){
            return $claimQuery->where('claim_no','like','%'.$req->claimno.'%');
        }else if($req->accdate!=null){
            return $claimQuery->where('acc_date',$req->accdate);
        }else if($req->recoveryAmt!=null){
            return $claimQuery->where('rec_amt',$req->recoveryAmt);
        }
        else if($req->accloc != null){
            return $claimQuery->where('acc_location',$req->accloc);
        }else if($req->assign_admin != null){
            return $claimQuery->where('is_assign',$req->assign_admin)->with('statusee');
        }
        else if($req->ic_name != null){
            return $claimQuery->where('company_id',$req->ic_name)->with('statusee');
        }
        else if($req->ic_user != null){
            return $claimQuery->where('cid',$req->ic_user)->with('statusee');
        }
        else if($req->start_date != null){
           // dd('erer');
           if($req->end_date != null){
                $startdate = DateTime::createFromFormat('Y-m-d', $req->start_date);
                $newDateString1 = $startdate->format('d/m/Y');
                $enddate = DateTime::createFromFormat('Y-m-d', $req->end_date);
                $newDateString2 = $enddate->format('d/m/Y');
                $startDate = Carbon::createFromFormat('d/m/Y', $newDateString1);
                $endDate = Carbon::createFromFormat('d/m/Y', $newDateString2);
           }else{
                $t=time();
                $enddate1=date("d/m/Y",$t);
                //dd($enddate1);
                $startdate = DateTime::createFromFormat('Y-m-d', $req->start_date);
                $newDateString1 = $startdate->format('d/m/Y');
                $startDate = Carbon::createFromFormat('d/m/Y', $newDateString1);
                $endDate = Carbon::createFromFormat('d/m/Y', $enddate1);
           }
            return $claimQuery->whereBetween('created_at', [$startDate, $endDate]);
        }
        else if($req->idclaim || $req->debname  || $req->accdate || $req->accloc){
            return $claimQuery->where('id', $req->idclaim)->orWhere('deb_name','like','%'.$req->debname.'%') 
                ->orWhere('claim_no','like','%'.$req->claimno.'%')->orWhere('acc_date',$req->accdate)->orWhere('acc_location',$req->accloc);
        }else if($req->rec_reason != null){
            return $claimQuery->orwhere('rec_reason','like','%'.$req->rec_reason.'%');
        }else if($req->art_remark != null){
            return $claimQuery->join('claim_data','claim_data.claim_id','=','claims.id')->where('claim_data.remarks','like','%'.$req->art_remark.'%')->select('claims.id','claims.company_id','claims.cid','claims.claim_no','claims.deb_mob','claims.deb_name',
                 'claims.type','claims.rec_amt','claims.acc_date','claims.created_at','claims.status','claims.deb_type','claims.acc_location',
                 'claims.deb_name','claims.deb_iqama','claims.is_assign')
                 ;
        }else if($req->filter != null){
            if($req->filter =="lowHigh"){
                return $claimQuery->orderByRaw('CAST(rec_amt AS DECIMAL(10, 2)) ASC');
            }else{
                return $claimQuery->orderByRaw('CAST(rec_amt AS DECIMAL(10, 2)) DESC');
            }
        }
        else{
            return $claimQuery;
        }
    }
    
    public function viewClaimsBeta(Request $request) {
        $claims = Claim::query()->with('claimData');
        $claims = $this->searchAndFilterClaims($request, $claims);
        if($request->is('officer/*')){
            $claims->where('is_assign',auth()->user()->id)->with('statusee');
        }
        $paginate = $request->paginate ?? 10;
       
        if($claims){
            $claims = $claims->paginate($paginate)
            ->withQueryString();
        }
       
        return view('admin.reg_claims', compact('claims'));
    }

    public function viewClaimsBetaPaginate($paginate) {
        if (Auth::user()->company_id != null) {
            $claims = Claim::select('id', 'company_id', 'cid', 'claim_no', 'deb_mob', 'deb_name', 'type', 'rec_amt', 'acc_date', 'created_at', 'status', 'deb_type', 'acc_location', 'deb_name', 'deb_iqama', 'is_assign')
                ->where('company_id', Auth::user()->company_id)->paginate($paginate);
            return view('admin.reg_claims', compact('claims'));
        } else {

            $claims = Claim::select('id', 'company_id', 'cid', 'claim_no', 'deb_mob', 'deb_name', 'type', 'rec_amt', 'acc_date', 'created_at', 'status', 'deb_type', 'acc_location', 'deb_name', 'deb_iqama', 'is_assign')->paginate($paginate);
            return view('admin.reg_claims', compact('claims'));
        }
    }

    public function paginateClaim(Request $req)
    {
        // dd($req->claim_per_page);
        $claims = Claim::select('id', 'company_id', 'cid', 'claim_no', 'deb_mob', 'deb_name', 'type', 'rec_amt', 'acc_date', 'created_at', 'status', 'deb_type', 'acc_location', 'deb_name', 'deb_iqama', 'is_assign')->paginate($req->claim_per_page);
        // return view('admin.reg_claims',compact('claims'));
        return redirect()->back()->with('claims', $claims);
    }

}
