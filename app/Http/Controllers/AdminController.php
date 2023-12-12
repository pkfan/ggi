<?php

namespace App\Http\Controllers;

use DB;
use File;
use Hash;
use Mail;
use Alert;
use Exception;
use SoapClient;
use Carbon\Carbon;
use App\Models\Loan;
use App\Models\User;
use App\Models\Batch;
use App\Models\Claim;
use App\Models\IcDoc;
use App\Models\Reason;
use App\Models\BatchId;
use App\Models\Company;
use App\Models\FileBin;
use App\Models\Message;
use App\Models\payment;
use Twilio\Rest\Client;
use App\Models\AdminDoc;
use App\Models\PayDelay;
use App\Models\PreClaim;
use Shuchkin\SimpleXLSX;
use App\Models\ClaimData;
use App\Models\ContactUs;
use App\Models\ElmStatus;
use App\Models\CallStatus;
use App\Models\DelayError;
use App\Models\PartialPay;
use App\Models\ClaimReason;
use App\Models\ClaimRemark;
use App\Models\ClaimStatus;
use App\Models\DivideClaim;
use App\Models\FinanceCase;
use App\Models\LawFirmCase;
use App\Models\PaymentLink;
use App\Models\SmsResponse;
use App\Models\ClaimComment;
use App\Models\DebtorRefuse;
use App\Models\Distribution;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Enums\BankSlipStatus;
use App\Models\OfficerTarget;
use App\Models\PartialManual;
use App\Models\SadadResponse;
use App\Models\StatusHistory;
use App\Models\Supported_Doc;
use App\Models\CollectedClaim;
use App\Models\DebtorResponse;
use App\Models\TransferMorror;
use App\Enums\PartialPayStatus;
use App\Models\FinancialCompany;
use App\Models\CustomPartialMada;
use App\Enums\PartialPaySmsStatus;
use App\Models\DebtorBankTransfer;
use App\Models\DebtorRefuseReason;
use App\Models\EditRemak;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Enums\ClaimStatus as ClaimStatusEnum;
// use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use App\Models\LegalDepartment;
use App\Models\RequestChangeStatusModel;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function editArtRemark(Request $req)
    {
        $remark = ClaimData::where('claim_id', $req->claim_id)->first();
        if ($remark != null) {
            $remark->remarks = $req->remark;
            $remark->save();

            $editRemark = new EditRemak;
            $editRemark->user_id = Auth::user()->id;
            $editRemark->claim_id = $req->claim_id;
            $editRemark->save();
            return back()->with('success', 'Remark added successfully');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }
    public function contactus(Request $req)
    {
        $contact = new ContactUs;
        $contact->name = $req->name;
        $contact->email = $req->email;
        $contact->subject = $req->subject;
        $contact->message = $req->message;
        $contact->save();
        return back()->with('success', 'Thank you! your query has been recorded');
    }

    public function getQuery()
    {
        $contact = ContactUs::all();
        return view('admin.queries', compact('contact'));
    }


































    // Admin Delete Claim
    //    public function adminDeleteClaim(Request $req)
    //    {
    //        $claim=Claim::where('id',$req->id)->first();
    //
    //        if ()
    //        {
    //
    //        }
    //    }


    //change firm status
    public function lfstatus($id)
    {
        $firm = User::where('id', $id)->first();
        if ($firm->status == 0) {
            $firm->status = 1;
            $firm->save();
            return back()->with('success', 'Law Firm Verified Now');
        } elseif ($firm->status == 1) {
            $firm->status = 0;
            $firm->save();
            return back()->with('success', 'Law Firm UnVerified Now');
        }
    }


    //assign firm
    public function assignfirm($res, $firm)
    {
        $refuse = new DebtorRefuse;
        $refuse->debtorresponse_id = $res;
        $refuse->lawfirm_id = $firm;
        $refuse->save();

        $response = DebtorResponse::where('id', $res)->first();
        $response->obj_status = 1;
        $response->save();

        Notification::create([
            'from' => $res,
            'to' => $firm,
            'message' => "Lawfirm . $firm. is assigned to . $res .'",
            'type' => 'Lawfirm',
            'read' => false,
        ]);
        return back()->with('success', 'Law Firm is Assigned Successfully');
    }




    public function uploaddoc(Request $req)
    {
        $doc = DebtorRefuse::where('id', $req->id)->first();

        $claim = getclaimdetail($doc->debtorresponse_id);

        if ($req->hasfile('file')) {
            foreach ($req->file('file') as $file) {
                $name = time() . '' . rand(3, 999);
                $ext = $file->getClientOriginalExtension();
                $filepath = 'addtionaldocumets/' . 'refused' . $doc->id . '/claimid/' . $claim->id . '/';
                $file->move(storage_path() . '/app/public/' . $filepath, $name);
                // $file->move(storage_path().'/uploads/'.$req->vehical_id.'/missing_parts', $name.'.'.$ext);
                $imgData[] = $filepath . $name;
            }
            $file = json_encode($imgData);
            $doc->add_doc = $file;
            $doc->save();

            return back()->with('success', 'Additional Documents Added Successfully');
        }
    }

    public function loanreqdetail($id)
    {
        $claim = Claim::where('id', $id)->first();
        return view('admin.loandetail', compact('claim'));
    }


    //selected financial company verify and unverify
    public function verify(Request $req)
    {

        if ($req->verify == 'verify') {
            if ($req->fcompany == null) {
                return back()->with('error', 'Please Select Row');
            } elseif (!empty($req->fcompany)) {
                foreach ($req->fcompany as $fcompany) {
                    $user = User::where('id', $fcompany)->first();
                    $user->status = 1;
                    $user->save();
                }
                return back()->with('success', 'All Selected Verified');
            }
        } elseif ($req->verify == 'unverify') {

            if ($req->fcompany == null) {
                return back()->with('error', 'Please Select Row');
            } elseif (!empty($req->fcompany)) {
                foreach ($req->fcompany as $fcompany) {
                    $user = User::where('id', $fcompany)->first();
                    $user->status = 0;
                    $user->save();
                }
                return back()->with('success', 'All Selected Un-Verified');
            }
        }
    }

    public function callresponse(Request $req)
    {
        $res = new Reason;
        if ($req->digits == null) {
            return "no response";
            $res->save();
        } else {
            $res->description = $req->digits;
            $res->save();
        }
    }
    public function changePassword(Request $req)
    {
        $req->validate([
            'currentpassword' => 'required',
            'newpassword' => 'required',
            'conpassword' => 'required'
        ]);

        $user = User::where('id', $req->id)->first();

        $password = $req->currentpassword;
        if (!Hash::check($password, $user->password)) {
            // Alert::error('error','Wrong Password');
            return back()->with('error', 'current password is wrong.');
        } else {
            if ($req->conpassword == $req->newpassword) {
                $user->password = Hash::make($req->newpassword);
                $user->save();
                // Alert::success('success','Password Changed Successfully');
                return back()->with('success', 'Password Changed Successfully');
            }
        }
    }

    public function unfonic(Request $req)
    {
        $res = new Reason;
        $res->description = "hello g response here";
        $res->save();
        return $res;
    }












    public function addRemarks(Request $req)
    {
        $claim = Claim::where('id', $req->claim_id)->first();
        $claim->remarks = $req->remarks;
        date_default_timezone_set("Asia/Riyadh");
        $claim->remarkUpdated = time();
        $claim->save();
        return back()->with('success', 'Remarks Added Successfully');
    }








    public function adminStaff(Request $req)
    {
        try {
            $user = new User;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->reg_no = $req->national_id;
            $user->password = Hash::make($req->password);
            $user->phone = '+966' . $req->mobile_no;
            $user->status = 1;
            $user->roll = 0;
            $user->is_super = 0;
            $user->save();
            return back()->with('success', 'Admin added successfully');
        } catch (\Exception $e) {

            return back()->with('error', 'Something went wrong');
        }
    }



    public function elmStatus1()
    {

        $data = (object)array(
            'GetStatus' =>
            array(
                'ClientId' => 7026274915,
                'ClientAuthorization' => 'hMrMOv3e70EUI87/G/kVAo/PtmKljsS3/0mi+gpEoNM=',
                'BatchNumber' => '9499c2b7-0004-4254-b2b7-d2ea1a427204',
            ),
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

        $soapClient = new \SoapClient($wsdl, $options);

        //$response=$soapClient ->GetStatus($data);
        return $soapClient;
    }






    public function allTransaction()
    {
        $debtorBankTransfers = DebtorBankTransfer::with('verifier')->get();

        // dd($sadad);
        return view('admin.alltransactions', compact('debtorBankTransfers'));
    }

    public function allTransactionStatus($debtor_bank_slip_id, $status)
    {
        $debtorBankTransfer = DebtorBankTransfer::find($debtor_bank_slip_id);
        if ($status == 'verify') {

            $claim = Claim::firstWhere('id', $debtorBankTransfer->claim_id);

            DB::transaction(function () use ($debtorBankTransfer, $debtor_bank_slip_id, $claim) {

                CollectedClaim::create([
                    'claim_id' => $debtorBankTransfer->claim_id,
                    'payment' => 'bank',
                    'update_by' => auth()->user()->id
                ]);

                // update officer target if exist
                // Carbon::createFromFormat('Y M d', $request->startDate)->format('Y-m-d');
                $year = now()->year;
                $month = now()->month;
                $day = now()->day;

                $currentDate = "{$year}-{$month}-{$day}";

                $officerTarget = OfficerTarget::where('officer_id', $claim->is_assign)
                    ->where('start_date', '<=', $currentDate)
                    ->where('end_date', '>=', $currentDate)
                    ->first();

                if ($officerTarget) {
                    $preAchievedTarget = $officerTarget->achieved ?? 0;

                    $achievedTarget = $claim->amount_after_discount + $preAchievedTarget;
                    $pendingTarget = $officerTarget->total - $achievedTarget;
                    $acheivedPercentage = ($achievedTarget / $officerTarget->total) * 100;

                    if ($pendingTarget < 0) {
                        $pendingTarget = 0;
                    }

                    OfficerTarget::where('officer_id', $claim->is_assign)
                        ->where('start_date', '<=', $currentDate)
                        ->where('end_date', '>=', $currentDate)
                        ->update([
                            'achieved' => $achievedTarget,
                            'pending' => $pendingTarget,
                            'acheived_percentage' => $acheivedPercentage,
                        ]);
                }

                DebtorBankTransfer::where('id', $debtor_bank_slip_id)->update([
                    'status' => BankSlipStatus::VERIFIED->value
                ]);
            });
        } else {
            // CollectedClaim::where('claim_id',$debtorBankTransfer->claim_id)->delete();

            DebtorBankTransfer::where('id', $debtor_bank_slip_id)->update([
                'status' => BankSlipStatus::UNVERIFIED->value
            ]);
        }

        // dd($sadad);
        return back()->with('success', 'successfully updated status.');
    }

    // public function allTransaction()
    // {
    //     if (Auth::user()->company_id != null) {
    //         $payment = payment::join('claims', 'claims.id', '=', 'payment.claim_id')->where('claims.company_id', Auth::user()->company_id)
    //             ->select(
    //                 'payment.created_at',
    //                 'claims.id',
    //                 'payment.claim_id',
    //                 'payment.payment_id',
    //                 'payment.result',
    //                 'payment.response_code',
    //                 'payment.rrn',
    //                 'payment.amount',
    //                 'payment.card_brand',
    //                 'payment.masked_pan'
    //             )
    //             ->get();
    //         $sum = payment::join('claims', 'claims.id', '=', 'payment.claim_id')->where('response_code', 000)->where('claims.company_id', Auth::user()->company_id)->sum('amount');
    //         $sadad = SadadResponse::where('status', 1)->get();
    //         dd($sadad);
    //         return view('admin.alltransactions', compact('payment', 'sum', 'sadad'));
    //     } else {
    //         // $payment=payment::all();
    //         // $sum=payment::where('response_code',000)->sum('amount');
    //         // return view('admin.alltransactions',compact('payment','sum'));
    //         $payment = payment::join('claims', 'claims.id', '=', 'payment.claim_id')->select(
    //             'payment.created_at',
    //             'claims.id',
    //             'payment.claim_id',
    //             'payment.payment_id',
    //             'payment.result',
    //             'payment.response_code',
    //             'payment.rrn',
    //             'payment.amount',
    //             'payment.card_brand',
    //             'payment.masked_pan'
    //         )
    //             ->get();
    //         $sum = payment::join('claims', 'claims.id', '=', 'payment.claim_id')->where('response_code', 000)->sum('amount');


    //         $sadad = SadadResponse::where('status', 1)->get();

    //         // dd($sadad);
    //         return view('admin.alltransactions', compact('payment', 'sum', 'sadad'));
    //     }
    // }


    public function icAllTransaction()
    {

        $payment = payment::join('claims', 'claims.id', '=', 'payment.claim_id')->where('claims.company_id', Auth::user()->company_id)
            ->select(
                'payment.created_at',
                'claims.id',
                'payment.claim_id',
                'payment.payment_id',
                'payment.result',
                'payment.response_code',
                'payment.rrn',
                'payment.amount',
                'payment.card_brand',
                'payment.masked_pan'
            )
            ->get();
        $sum = payment::join('claims', 'claims.id', '=', 'payment.claim_id')->where('response_code', 000)->where('claims.company_id', Auth::user()->company_id)->sum('amount');
        $sadad = SadadResponse::join('claims', 'claims.id', '=', 'sadad_response.claimid')->where('claims.company_id', Auth::user()->company_id)
            ->where('sadad_response.status', 1)->get();

        return view('ic.alltransactions', compact('payment', 'sum', 'sadad'));
    }




    public function payDelay(Request $req)
    {
        $req->validate([
            'delaydate' => 'required',
            // 'type' => 'required'
        ]);
        $datetime = str_replace('T', ' ', $req->delaydate);
        DB::beginTransaction();
        try {
            $count = ClaimStatus::where('claim_id', $req->claimid)->count();
            $claimstatus = ClaimStatus::where('claim_id', $req->claimid)->first();
            if ($count == 0) {
                $claimstatus = new ClaimStatus();
                $claimstatus->claim_id = $req->claimid;
                $claimstatus->status = 3;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 3, Auth::user()->id);
            } else {
                $claimstatus->status = 3;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 3, Auth::user()->id);
            }
            $pay = new PayDelay();
            $pay->claim_id = $req->claimid;
            $pay->update_by = Auth::user()->id;
            $pay->date_time = $datetime . ":00";
            $pay->type = $req->type;
            $pay->save();
            $claim = Claim::where('id', $req->claimid)->first();
            $reciever = $claim->deb_mob;
            $message = 'عزيزي العميل ' . $claim->deb_name . 'نفيدكم انه تم الموافقة على تأجيل السداد علما ان موعد الدفعة المستحقة سيكون بتاريخ ' . $pay->date_time . ' بمبلغ ' . $claim->amount_after_discount . ' وسيصلكم رابط الدفع بالتاريخ
            المحدد';
            try {
                //customCall($reciever, '62dab232-ebdd-4bfe-9430-3df019cf5e1b');
                adminSendMessage($reciever, $message, $req->claimid);
            } catch (\Exception $e) {
                $delay_error = new DelayError;
                $delay_error->claim_id = $req->claimid;
                $delay_error->error = "SMS not send";
                $delay_error->save();
                return back()->with('error', 'Something went wrong');
            }
            $email = getEmail(Auth::user()->id);
            // try {
            //     $details = [
            //         'remark' => 'Delay payment Reminder',
            //         'claim_id' => $req->claimid
            //     ];
            //     Mail::to($email)->send(new \App\Mail\Remainder($details));
            // } catch (\Exception $e) {
            //     dd($e);
            //     return back()->with('error', 'Something went wrong');
            // }
            $partial = PartialPay::where('claim_id', $req->claimid)->get();
            if ($partial) {
                PartialPay::where('claim_id', $req->claimid)
                    ->update(['status' => 5]);
                // $partial->each->delete();
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
                $reason->status = 3;
                $reason->save();
            }
            DB::commit();
            return back()->with('success', 'Successfully set');
        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();
            return back()->with('error', 'Something went wrong');
        }
    }





    public function payPartial(Request $req)
    {

        // if($req->last_plan == 'no'){
        //     $req->validate([
        //         'pardate' => 'required',
        //         'plan'=>'required',
        //     ]);
        // }

        $req->validate([
            'pardate' => 'required',
            'plan' => 'required',
        ]);

        $claim = Claim::where('id', $req->claimid)->first();

        // checking if all $req->amount[] has total of all claim reserve amount
        $totalRequestInputPartialsAmount = 0;

        foreach ($req->amount as $singlePartialAmountString) {
            $singlePartialAmount = (int) $singlePartialAmountString;
            $totalRequestInputPartialsAmount += $singlePartialAmount;
        }

        if ($totalRequestInputPartialsAmount != $claim->amount_after_discount) {
            return back()->with('error', 'Partial Input Amounts of installment is not equal to total claim reserve amount, please check all partials and fix those.')
                ->withErrors(['error' => 'Partial Input Amounts of installment is not equal to total claim reserve amount, please check all partials and fix those.']);
        }

        // if any partial is paid then we cannot delete old partials and continue with those
        $isPaidPartialExist = PartialPay::where('claim_id', $req->claimid)
            ->where(function ($query) {
                $query->where('status', PartialPayStatus::PAID->value)
                    ->orWhere('status', PartialPayStatus::MANUAL_PAID->value);
            })
            ->first();

        if ($isPaidPartialExist) {
            return back()->with('error', 'You cannot create new parital, because old partial already exist and some paid.')
                ->withErrors(['error' => 'You cannot create new parital, because some paid installment from old ones of this claim already exist']);
        }




        DB::beginTransaction();
        try {


            $count = ClaimStatus::where('claim_id', $req->claimid)->count();
            $claimstatus = ClaimStatus::where('claim_id', $req->claimid)->first();

            if ($count == 0) {
                $claimstatus = new ClaimStatus();
                $claimstatus->claim_id = $req->claimid;
                $claimstatus->status = ClaimStatusEnum::PARTIAL_SETTLEMENT->value;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                //   dd($claimstatus);
            } else {
                $claimstatus->status =  ClaimStatusEnum::PARTIAL_SETTLEMENT->value;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
            }

            statusHistory($req->claimid,  ClaimStatusEnum::PARTIAL_SETTLEMENT->value, Auth::user()->id);


            $datetime = str_replace('T', ' ', $req->pardate);

            // $date = new Carbon($datetime);
            // $paymentdate =  $date->addDays(30);

            $date = new Carbon($datetime);

            $existornot = PartialPay::where('claim_id', $req->claimid)->count();

            if (!$req->last_plan || $req->last_plan == 'no') {


                // delete last (old) partials installment
                PartialPay::where('claim_id', $req->claimid)->delete();

                // create new partials installment
                // $pamt = $claim->amount_after_discount / $req->plan;
                // $pamt = round($pamt, 2);

                for ($i = 0; $i < $req->plan; $i++) {
                    $days = 30;
                    $installment = $i + 1;
                    $partial = new PartialPay;
                    $partial->claim_id = $req->claimid;
                    if ($i == 0) {
                        $partial->date_time = $datetime . ":00";
                    } else {
                        $partial->date_time = $date->addDays($days);
                        $days = $days + 30;
                    }

                    $partial->update_by = Auth::user()->id;
                    $partial->type = $req->type;
                    $partial->amount = $req->amount[$i];
                    $partial->installment = $installment;
                    $partial->status = PartialPayStatus::UPCOMMING->value;
                    $partial->sms_status = PartialPaySmsStatus::SMS_NOT_SEND->value;
                    $partial->save();
                }

                ///////////////// following are from old code and note change by me ///////////////

                /**
                 * we can call shedule command here instead of manually send code | Muhammad Amir
                 */

                // start sms code
                $claim = Claim::where('id', $req->claimid)->first();

                $installements = PartialPay::where('claim_id', $claim->id)->count();

                $reciever = $claim->deb_mob;

                $message = 'عزيزي العميل نفيدكم انه تم الموافقة على التسوية بواقع ' . $installements . ' دفعات حيث سيتم ارسال رابط الدفع لكم دوريا حسب التاريخ المتفق عليه مسبقا.';


                try {
                    //customCall($reciever, '7a832f78-0931-4833-a60f-653cf0d08d3a');
                    adminSendMessage($reciever, $message, $req->claimid);
                } catch (\Exception $e) {
                    // dd($e);
                    $delay_error = new DelayError;
                    $delay_error->claim_id = $req->claimid;
                    $delay_error->error = "SMS not send";
                    $delay_error->save();
                    return back()->with('error', 'Something went wrong');
                }


                // $amount = $claim->amount_after_discount / $req->plan;
                // $amount = round($amount, 2);
                // //  dd($amount);
                // $current_date = Carbon::now()->format('Y-m-d H:i');
                // // dd($current_date,$datetime);
                // if ($current_date . ":00" ==  $datetime . ":00") {
                //     // dd('hello');
                //     $link =  createPaymentLinkAmt($req->claimid, $amount);
                //     $pay = PartialPay::where('date_time', $current_date . ":00")->where('claim_id', $req->claimid)->first();
                //     $pay->link = $link;

                //     $pay->status = 2;

                //     $pay->save();

                //     $message = 'عزيزي العميل نرجو التكرم بسداد المبلغ ' . $amount . ' الرجاء الضغط على الرابط التالي ليتم السداد من خلال احدى قنوات الدفع الرسمية المعتمدة لديكم ' . $link . ' ، تذكر دائماً أن تهيئة لن تطلب أي أرقام سرية خاصة بكم بأي حال من الأحوال';
                //     try {
                //         customCall($reciever, '7207c9ee-4d2b-47ba-8261-8059fd0dd982');
                //         adminSendMessage($reciever, $message, $req->claimid);
                //     } catch (\Exception $e) {
                //         $delay_error = new DelayError;
                //         $delay_error->claim_id = $req->claimid;
                //         $delay_error->error = "SMS not send";
                //         $delay_error->save();
                //         // dd($e);
                //         return back()->with('error', 'Something went wrong');
                //     }
                // }

                // // end sms code

                $paydelay = PayDelay::where('claim_id', $req->claimid)->get();
                if ($paydelay) {
                    PayDelay::where('claim_id', $req->claimid)
                        ->update(['status' => 5]);
                }
                $debrefuse = DebtorRefuseReason::where('claim_id', $req->claimid)->get();
                if ($debrefuse) {
                    //$debrefuse->each->delete();
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
                    $reason->status = 4;
                    $reason->save();
                }

                DB::commit();
                return back()->with('success', 'Partial Payment Set Successfully');
            }

            // if ($req->last_plan == 'no' || $req->last_plan == null) {



            //     $partialdel =  PartialPay::where('claim_id', $req->claimid)->where('status', 5)->get();
            //     $partialdel->each->delete();


            //     $pamt = $claim->amount_after_discount / $req->plan;
            //     $pamt = round($pamt, 2);
            //     for ($i = 0; $i < $req->plan; $i++) {

            //         $j = 30;
            //         $partial = new PartialPay;
            //         $partial->claim_id = $req->claimid;
            //         if ($i == 0) {
            //             $partial->date_time = $datetime . ":00";
            //         } else {
            //             $partial->date_time = $date->addDays(30);
            //             $j = $j + 30;
            //         }

            //         $partial->update_by = Auth::user()->id;
            //         $partial->type = $req->type;
            //         $partial->amount = $pamt;
            //         $partial->save();
            //     }
            //     $claim = Claim::where('id', $req->claimid)->first();

            //     $installements = PartialPay::where('claim_id', $claim->id)->count();

            //     $reciever = $claim->deb_mob;

            //     $message = 'عزيزي العميل نفيدكم انه تم الموافقة على التسوية بواقع ' . $installements . ' دفعات حيث سيتم ارسال رابط الدفع لكم دوريا حسب التاريخ المتفق عليه مسبقا.';


            //     try {
            //         customCall($reciever, '7a832f78-0931-4833-a60f-653cf0d08d3a');
            //         adminSendMessage($reciever, $message, $req->claimid);
            //     } catch (\Exception $e) {
            //         // dd($e);
            //         $delay_error = new DelayError;
            //         $delay_error->claim_id = $req->claimid;
            //         $delay_error->error = "SMS not send";
            //         $delay_error->save();
            //         return back()->with('error', 'Something went wrong');
            //     }


            //     $amount = $claim->amount_after_discount / $req->plan;
            //     $amount = round($amount, 2);
            //     //  dd($amount);
            //     $current_date = Carbon::now()->format('Y-m-d H:i');
            //     // dd($current_date,$datetime);
            //     if ($current_date . ":00" ==  $datetime . ":00") {
            //         // dd('hello');
            //         $link =  createPaymentLinkAmt($req->claimid, $amount);
            //         $pay = PartialPay::where('date_time', $current_date . ":00")->where('claim_id', $req->claimid)->first();
            //         $pay->link = $link;

            //         $pay->status = 2;

            //         $pay->save();

            //         $message = 'عزيزي العميل نرجو التكرم بسداد المبلغ ' . $amount . ' الرجاء الضغط على الرابط التالي ليتم السداد من خلال احدى قنوات الدفع الرسمية المعتمدة لديكم ' . $link . ' ، تذكر دائماً أن تهيئة لن تطلب أي أرقام سرية خاصة بكم بأي حال من الأحوال';
            //         try {
            //             customCall($reciever, '7207c9ee-4d2b-47ba-8261-8059fd0dd982');
            //             adminSendMessage($reciever, $message, $req->claimid);
            //         } catch (\Exception $e) {
            //             $delay_error = new DelayError;
            //             $delay_error->claim_id = $req->claimid;
            //             $delay_error->error = "SMS not send";
            //             $delay_error->save();
            //             // dd($e);
            //             return back()->with('error', 'Something went wrong');
            //         }
            //     }


            //     $paydelay = PayDelay::where('claim_id', $req->claimid)->get();
            //     if ($paydelay) {
            //         PayDelay::where('claim_id', $req->claimid)
            //             ->update(['status' => 5]);
            //     }
            //     $debrefuse = DebtorRefuseReason::where('claim_id', $req->claimid)->get();
            //     if ($debrefuse) {
            //         //$debrefuse->each->delete();
            //         DebtorRefuseReason::where('claim_id', $req->claimid)
            //             ->update(['status' => 5]);
            //     }
            //     $debresp = DebtorResponse::where('claim_id', $req->claimid)->get();
            //     if ($debresp) {
            //         // $debresp->each->delete();
            //         DebtorResponse::where('claim_id', $req->claimid)
            //             ->update(['status' => 5]);
            //     }
            //     $morror = TransferMorror::where('claim_id', $req->claimid)->first();
            //     if ($morror) {
            //         TransferMorror::where('claim_id', $req->claimid)
            //             ->update(['status' => 2]);
            //     }

            //     $financcase = FinanceCase::where('claim_id', $req->claimid)->first();
            //     if ($financcase) {
            //         $financcase->delete();
            //     }

            //     $collected = CollectedClaim::where('claim_id', $req->claimid)->get();
            //     if ($collected) {
            //         // $collected->each->delete();
            //         CollectedClaim::where('claim_id', $req->claimid)
            //             ->update(['status' => 5]);
            //     }

            //     $firm = LawFirmCase::where('claim_id', $req->claimid)->first();
            //     if ($firm) {
            //         $firm->delete();
            //     }


            //     if ($req->statusreason != null) {
            //         $reason = new ClaimReason;
            //         $reason->claim_id = $req->claimid;
            //         $reason->update_by = Auth::user()->id;
            //         $reason->reason = $req->statusreason;
            //         $reason->status = 4;
            //         $reason->save();
            //     }

            //     DB::commit();
            //     return back()->with('success', 'Partial Payment Set Successfully');
            // }
            // else if ($req->last_plan == 'yes') {

            //     $claim = Claim::where('id', $req->claimid)->first();
            //     $reciever = $claim->deb_mob;
            //     customCall($reciever, '7207c9ee-4d2b-47ba-8261-8059fd0dd982');
            //     PartialPay::where('claim_id', $req->claimid)->where('status', 5)
            //         ->update(['status' => 1]);

            //     $paydelay = PayDelay::where('claim_id', $req->claimid)->get();
            //     if ($paydelay) {
            //         PayDelay::where('claim_id', $req->claimid)
            //             ->update(['status' => 5]);
            //     }
            //     $debrefuse = DebtorRefuseReason::where('claim_id', $req->claimid)->get();
            //     if ($debrefuse) {
            //         //$debrefuse->each->delete();
            //         DebtorRefuseReason::where('claim_id', $req->claimid)
            //             ->update(['status' => 5]);
            //     }
            //     $debresp = DebtorResponse::where('claim_id', $req->claimid)->get();
            //     if ($debresp) {
            //         // $debresp->each->delete();
            //         DebtorResponse::where('claim_id', $req->claimid)
            //             ->update(['status' => 5]);
            //     }
            //     $morror = TransferMorror::where('claim_id', $req->claimid)->first();
            //     if ($morror) {
            //         TransferMorror::where('claim_id', $req->claimid)
            //             ->update(['status' => 2]);
            //     }

            //     $financcase = FinanceCase::where('claim_id', $req->claimid)->first();
            //     if ($financcase) {
            //         $financcase->delete();
            //     }

            //     $collected = CollectedClaim::where('claim_id', $req->claimid)->get();
            //     if ($collected) {
            //         // $collected->each->delete();
            //         CollectedClaim::where('claim_id', $req->claimid)
            //             ->update(['status' => 5]);
            //     }

            //     $firm = LawFirmCase::where('claim_id', $req->claimid)->first();
            //     if ($firm) {
            //         $firm->delete();
            //     }

            //     if ($req->statusreason != null) {
            //         $reason = new ClaimReason;
            //         $reason->claim_id = $req->claimid;
            //         $reason->update_by = Auth::user()->id;
            //         $reason->reason = $req->statusreason;
            //         $reason->status = 4;
            //         $reason->save();
            //     }
            //     DB::commit();
            //     return back()->with('success', 'Partial Payment  Retrieved');
            // }

            else {

                return back()->with('error', 'Partial Payment already exist');
            }
        } catch (\Exception $e) {
            //  dd($e);
            DB::rollback();
            return back()->with('error', 'Something went wrong');
        }
    }



    public function transferMorr(Request $req)
    {

        DB::beginTransaction();
        try {
            $count = ClaimStatus::where('claim_id', $req->claimid)->count();
            $claimstatus = ClaimStatus::where('claim_id', $req->claimid)->first();
            if ($count == 0) {
                $claimstatus = new ClaimStatus();
                $claimstatus->claim_id = $req->claimid;
                $claimstatus->status = 5;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 5, Auth::user()->id);
            } else {
                $claimstatus->status = 5;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 5, Auth::user()->id);
            }
            $transfer = new TransferMorror;
            $transfer->claim_id = $req->claimid;
            $transfer->update_by = Auth::user()->id;
            $transfer->city = $req->morrorcity;
            $transfer->department = $req->department;
            $transfer->collector = $req->collector;
            $transfer->status = 1;
            $transfer->save();






            $responseCount = DebtorResponse::where('claim_id', $req->claimid)->count();
            if ($responseCount != 0) {
                $response = DebtorResponse::where('claim_id', $req->claimid)->first();
                $response->obj_status = 5;
                $response->save();
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
                // $partial->each->delete();
            }
            $debrefuse = DebtorRefuseReason::where('claim_id', $req->claimid)->get();
            if ($debrefuse) {
                // $debrefuse->each->delete();
                DebtorRefuseReason::where('claim_id', $req->claimid)
                    ->update(['status' => 5]);
            }
            $debresp = DebtorResponse::where('claim_id', $req->claimid)->get();
            if ($debresp) {
                DebtorResponse::where('claim_id', $req->claimid)
                    ->update(['status' => 5]);
                //$debresp->each->delete();
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
                $reason->status = 5;
                $reason->save();
            }


            DB::commit();
            return back()->with('success', 'Status Added Successfully');
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return back()->with('error', 'Something went wrong');
        }
    }

    public function transferLawyer(Request $req)
    {

        DB::beginTransaction();
        try {


            $count = ClaimStatus::where('claim_id', $req->claimid)->count();
            $claimstatus = ClaimStatus::where('claim_id', $req->claimid)->first();

            if ($count == 0) {
                $claimstatus = new ClaimStatus();
                $claimstatus->claim_id = $req->claimid;
                $claimstatus->status = 6;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 6, Auth::user()->id);
            } else {
                $claimstatus->status = 6;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 6, Auth::user()->id);
            }
            $lawfirm = new LawFirmCase;
            $lawfirm->claim_id = $req->claimid;
            $lawfirm->lawfirm_id = $req->lawfirm;
            $lawfirm->update_by = Auth::user()->id;
            $lawfirm->status = 1;
            $lawfirm->save();

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
                DebtorRefuseReason::where('claim_id', $req->claimid)
                    ->update(['status' => 5]);
                //$debrefuse->each->delete();
            }
            $debresp = DebtorResponse::where('claim_id', $req->claimid)->get();
            if ($debresp) {
                DebtorResponse::where('claim_id', $req->claimid)
                    ->update(['status' => 5]);
                // $debresp->each->delete();
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
                //$collected->each->delete();
                CollectedClaim::where('claim_id', $req->claimid)
                    ->update(['status' => 5]);
            }

            if ($req->statusreason != null) {
                $reason = new ClaimReason;
                $reason->claim_id = $req->claimid;
                $reason->update_by = Auth::user()->id;
                $reason->reason = $req->statusreason;
                $reason->status = 6;
                $reason->save();
            }

            DB::commit();
            return back()->with('success', 'Status Added Successfully');
        } catch (\Exception $e) {
            //dd($e);
            DB::rollbacK();
            return back()->with('error', 'Something went wrong');
        }
    }

    public function transferFinance(Request $req)
    {

        DB::beginTransaction();
        try {


            $count = ClaimStatus::where('claim_id', $req->claimid)->count();
            $claimstatus = ClaimStatus::where('claim_id', $req->claimid)->first();

            if ($count == 0) {
                $claimstatus = new ClaimStatus();
                $claimstatus->claim_id = $req->claimid;
                $claimstatus->status = 7;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 7, Auth::user()->id);
            } else {
                $claimstatus->status = 7;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 7, Auth::user()->id);
            }
            $finance = new FinanceCase;
            $finance->claim_id = $req->claimid;
            $finance->finance_id = $req->finance;
            $finance->update_by = Auth::user()->id;
            $finance->status = 1;
            $finance->save();

            $paydelay = PayDelay::where('claim_id', $req->claimid)->get();
            if ($paydelay) {
                PayDelay::where('claim_id', $req->claimid)
                    ->update(['status' => 5]);
            }

            $partial = PartialPay::where('claim_id', $req->claimid)->get();
            if ($partial) {
                PartialPay::where('claim_id', $req->claimid)
                    ->update(['status' => 5]);
                // $partial->each->delete();
            }
            $debrefuse = DebtorRefuseReason::where('claim_id', $req->claimid)->get();
            if ($debrefuse) {
                // $debrefuse->each->delete();
                DebtorRefuseReason::where('claim_id', $req->claimid)
                    ->update(['status' => 5]);
            }
            $debresp = DebtorResponse::where('claim_id', $req->claimid)->get();
            if ($debresp) {
                //  $debresp->each->delete();
                DebtorResponse::where('claim_id', $req->claimid)
                    ->update(['status' => 5]);
            }
            $morror = TransferMorror::where('claim_id', $req->claimid)->first();
            if ($morror) {
                TransferMorror::where('claim_id', $req->claimid)
                    ->update(['status' => 2]);
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
                $reason->status = 7;
                $reason->save();
            }

            DB::commit();
            return back()->with('success', 'Status Added Successfully');
        } catch (\Exception $e) {
            //dd($e);
            DB::rollback();
            return back()->with('error', 'Something went wrong');
        }
    }

    public function  transferIc(Request $req)
    {
        DB::beginTransaction();
        try {


            $count = ClaimStatus::where('claim_id', $req->claimid)->count();
            $claimstatus = ClaimStatus::where('claim_id', $req->claimid)->first();

            if ($count == 0) {
                $claimstatus = new ClaimStatus();
                $claimstatus->claim_id = $req->claimid;
                $claimstatus->status = 9;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 9, Auth::user()->id);
            } else {
                $claimstatus->status = 9;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 9, Auth::user()->id);
            }
            $comment = new ClaimComment;
            $comment->claim_id = $req->claimid;
            $comment->ic_id = $req->company_id;
            $comment->update_by = Auth::user()->id;
            $comment->comment = $req->comments;
            $comment->status = 1; //status =1 admin comment status 2 ic comment
            $comment->save();

            if ($req->statusreason != null) {
                $reason = new ClaimReason;
                $reason->claim_id = $req->claimid;
                $reason->update_by = Auth::user()->id;
                $reason->reason = $req->statusreason;
                $reason->status = 9;
                $reason->save();
            }

            DB::commit();
            return back()->with('success', 'Comment Added Successfully');
        } catch (\Exception $e) {
            //dd($e);
            DB::rollback();
            return back()->with('error', 'Something went wrong');
        }
    }
    public function transferElm(Request $req)
    {
        DB::beginTransaction();
        try {


            $count = ClaimStatus::where('claim_id', $req->claimid)->count();
            $claimstatus = ClaimStatus::where('claim_id', $req->claimid)->first();

            if ($count == 0) {
                $claimstatus = new ClaimStatus();
                $claimstatus->claim_id = $req->claimid;
                $claimstatus->status = 8;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 8, Auth::user()->id);
            } else {
                $claimstatus->status = 8;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 8, Auth::user()->id);
            }
            $claim = Claim::where('id', $req->claimid)->first();
            $claim->deb_iqama = $req->deb_iqama;
            $claim->deb_mob = '';
            $claim->status = 1;
            $uniqueCode = rand('10000', '99999') . 'taheiya' . rand('10000', '99999');
            $claim->link = $uniqueCode;
            $claim->save();

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
            } catch (SoapFault $fault) {
                return back()->with('error', 'Something went wrong');
                return redirect()->route('AdminViewClaims');
                // trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);

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

            $collected = CollectedClaim::where('claim_id', $req->claimid)->get();
            if ($collected) {
                //$collected->each->delete();
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
                $reason->status = 1;
                $reason->save();
            }

            DB::commit();
            return back()->with('success', 'Status Added Successfully');
        } catch (\Exception $e) {
            //dd($e);
            DB::rollback();
            return back()->with('error', 'Something went wrong');
        }
    }



    //admin create new payment links
    public function rePaymentLink(Request $req)
    {
        // dd($req->all());
        try {
            $claim = Claim::where('id', $req->claimid)->first();
            $idorder = 'PHP_' . rand(1, 1000); //Customer Order ID
            $terminalId = env('URWAYS_TERMINAL'); // Will be provided by URWAY
            $password = env('URWAYS_PASSWORD'); // Will be provided by URWAY
            $merchant_key = env('URWAYS_MERCHANT'); // Will be provided by URWAY
            $currencycode = "SAR";
            $amount = $req->amount;


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
                "udf2"              => route('AdminPayLink'), //Response page URL 'PaymentResponsePage'
                "udf3"              => "",
                "udf4"              => "",
                "udf5"              => "Test5",
                "claim_id"              => $claim->id,
                'requestHash' => $hash  //generated Hash


            ]);
            $data = json_decode($response->getBody(), true);

            $url =  $data['targetUrl'] . '?paymentid=' .   $data['payid'];

            if ($req->save == 'yes') {
                $claim->link = $url;
                $claim->save();
            }


            $paymentLink = new PaymentLink;
            $paymentLink->claim_id = $claim->id;
            $paymentLink->link = $url;
            $paymentLink->amount = $req->amount;
            $paymentLink->payment_id = $data['payid'];
            $paymentLink->status = 1;
            $paymentLink->save();

            return back()->with('success', 'link generated successfully');
        } catch (\Exception $e) {
            dd($e);
            return back()->with('error', 'Something went wrong');
        }
    }
    //only admin documents
    public function additionalDoc(Request $req)
    {
        // dd($req->all());
        try {
            $claim = Claim::where('id', $req->claimid)->first();
            if ($req->hasfile('addFile')) {
                foreach ($req->file('addFile') as $file) {
                    $doc = new AdminDoc;
                    $ran = rand(3, 9999);
                    $name = time() . $ran . '.' . $file->getClientOriginalExtension();
                    $filepath = 'claims/' . $claim->id . '/company/' . $claim->cid . '/AdminDoc/';
                    $file->move(storage_path() . '/app/public/' . $filepath, $name);
                    $doc->document = $filepath . $name;
                    $doc->claim_id = $claim->id;
                    $doc->status = 1;
                    $doc->save();
                }
            }
            return back()->with('success', 'Additional uploaded successfully');
        } catch (\Exception $e) {
            dd($e);
            return back()->with('error', 'Something went wrong');
        }
    }
    //generate discharge letter
    public function generateLetter($id)
    {
        $claim = Claim::where('id', $id)->first();
        //    $companyName=getCompanyById($claim->company_id)->name;
        $companyname = 'Al Rajhi Takaful';
        $debname = $claim->deb_name;
        $amount = $claim->amount_after_discount;
        $claimno = $claim->claim_no;
        $iqama = $claim->deb_iqama;
        $detail = [$iqama, $debname, $amount, $claimno, $companyName];
        return view('disletter', compact('detail'));
    }

    public function editPartial(Request $req)
    {

        $partial = PartialPay::where('id', $req->id)->first();
        $datetime = str_replace('T', ' ', $req->partialeddate);
        $partial->date_time = $datetime . ":00";
        $partial->status = 1;
        $partial->save();
        return back()->with('success', 'Partial date changed successfully');;
    }
    public function editDelay(Request $req)
    {

        $partial = PayDelay::where('id', $req->id)->first();
        $datetime = str_replace('T', ' ', $req->delayeddate);
        $partial->date_time = $datetime . ":00";
        $partial->status = 1;
        $partial->save();
        return back()->with('success', 'Delay date changed successfully');
    }

    // public function collectedClaimInfo(Request $req){


    //     $collected=array();
    //     $amt=array();
    //     $collected=0;
    //      for($i=1;$i<=12;$i++){
    //         $collected[$i] = Claim::select('created_at')->whereYear('created_at', '=', 2022)
    //          ->whereMonth('created_at', '=', $i)->where('status',1)->where('company_id',3)
    //          ->where('cid',70)
    //          ->get();

    //         //  $total[$i] = Claim::select('created_at')->whereYear('created_at', '=', $req->year)
    //         //  ->whereMonth('created_at', '=', $i)->where('company_id',$req->company)
    //         //  ->count();

    //      }

    //      dd($collected);
    // }

    ////////registerd claim grpah///////////////
    public function filterForm(Request $req)
    {

        $accepted = array();
        $returned = array();
        $review = array();
        $total = array();
        for ($i = 1; $i <= 12; $i++) {
            $accepted[$i] = Claim::select('created_at')->whereYear('created_at', '=', $req->year)
                ->whereMonth('created_at', '=', $i)->where('status', 1)->where('company_id', $req->company)
                ->count();

            $returned[$i] = Claim::select('created_at')->whereYear('created_at', '=',  $req->year)
                ->whereMonth('created_at', '=', $i)->where('status', 2)->where('company_id', $req->company)
                ->count();

            $review[$i] = Claim::select('created_at')->whereYear('created_at', '=',  $req->year)
                ->whereMonth('created_at', '=', $i)->where('status', 0)->where('company_id', $req->company)
                ->count();

            $total[$i] = Claim::select('created_at')->whereYear('created_at', '=', $req->year)
                ->whereMonth('created_at', '=', $i)->where('company_id', $req->company)
                ->count();
        }

        $post = [$accepted, $returned, $review, $total];

        return response()->json($post, 200);
    }
    ///////////end registerd claim graph/////////

    ////////////collected Claims///////////////
    public function collectedClaimInfo(Request $req)
    {
        //dd($req->all());

        $collected = array();
        $amount = array();
        $month = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        for ($i = 1; $i <= 12; $i++) {
            // $collected[$i] = Claim::whereYear('created_at', '=', $req->year)
            //  ->whereMonth('created_at', '=', $i)->where('company_id',$req->company)
            //  ->where('cid',$req->admin)->join('claimscollected','claimscollected.claim_id','=','claims.id')
            //  ->count();
            $collected[$i] = Claim::join('claim_collected', 'claim_collected.claim_id', '=', 'claims.id')
                ->where('claims.company_id', $req->company)->where('claim_collected.update_by', $req->admin)
                ->select('claim_collected.created_at')->whereYear('claim_collected.created_at', '=', $req->year)
                ->whereMonth('claim_collected.created_at', '=', $i)
                ->count();
            $collected[$i] = $collected[$i] . ' ' . $month[$i];

            $amount[$i] = Claim::join('claim_collected', 'claim_collected.claim_id', '=', 'claims.id')
                ->where('claims.company_id', $req->company)->where('claim_collected.update_by', $req->admin)
                ->select('claim_collected.created_at')->whereYear('claim_collected.created_at', '=', $req->year)
                ->whereMonth('claim_collected.created_at', '=', $i)
                ->sum('claims.rec_amt');
            //  $total[$i] = Claim::select('created_at')->whereYear('created_at', '=', $req->year)
            //  ->whereMonth('created_at', '=', $i)->where('company_id',$req->company)
            //  ->count();

        }

        $post = [$collected, $amount];
        return response()->json($post, 200);
    }
    /////////end collected claims//////////////

    /////////monthly claim status/////////////////
    public function claimStatusInfo(Request $req)
    {
        // dd($req->all());

        //  for($i=1;$i<=12;$i++){
        $i = $req->month;
        $register = Claim::select('created_at')->whereYear('created_at', '=', $req->year)
            ->whereMonth('created_at', '=', $i)->where('status', 0)->where('company_id', $req->company)
            ->where('is_assign', $req->admin)
            ->count();

        $registeramt = Claim::select('created_at')->whereYear('created_at', '=', $req->year)
            ->whereMonth('created_at', '=', $i)->where('status', 0)->where('company_id', $req->company)
            ->where('is_assign', $req->admin)
            ->sum('rec_amt');


        $collected = Claim::join('claim_collected', 'claim_collected.claim_id', '=', 'claims.id')
            ->where('claims.company_id', $req->company)->where('claim_collected.update_by', $req->admin)
            ->select('claim_collected.created_at')->whereYear('claim_collected.created_at', '=', $req->year)
            ->whereMonth('claim_collected.created_at', '=', $i)
            ->count();

        $colllectedamt = Claim::join('claim_collected', 'claim_collected.claim_id', '=', 'claims.id')
            ->where('claims.company_id', $req->company)->where('claim_collected.update_by', $req->admin)
            ->select('claim_collected.created_at')->whereYear('claim_collected.created_at', '=', $req->year)
            ->whereMonth('claim_collected.created_at', '=', $i)
            ->sum('claims.rec_amt');


        $directpay = Claim::join('payment', 'payment.claim_id', '=', 'claims.id')
            ->where('claims.company_id', $req->company)->where('claims.is_assign', $req->admin)
            ->where('payment.response_code', 000)
            ->select('payment.created_at')->whereYear('payment.created_at', '=', $req->year)
            ->whereMonth('payment.created_at', '=', $i)
            ->count();

        $directamt = Claim::join('payment', 'payment.claim_id', '=', 'claims.id')
            ->where('claims.company_id', $req->company)->where('claims.is_assign', $req->admin)
            ->select('payment.created_at')->whereYear('payment.created_at', '=', $req->year)
            ->where('payment.response_code', 000)
            ->whereMonth('payment.created_at', '=', $i)
            ->sum('payment.amount');

        $totalamount = $colllectedamt + $directamt;

        $delay = Claim::join('claim_status', 'claim_status.claim_id', '=', 'claims.id')
            ->where('claims.company_id', $req->company)->where('claim_status.status', 3)->where('claim_status.update_by', $req->admin)
            ->select('claim_status.created_at')->whereYear('claim_status.created_at', '=', $req->year)
            ->whereMonth('claim_status.created_at', '=', $i)->count();


        $delayamt = Claim::join('claim_status', 'claim_status.claim_id', '=', 'claims.id')
            ->where('claims.company_id', $req->company)->where('claim_status.status', 3)->where('claim_status.update_by', $req->admin)
            ->select('claim_status.created_at')->whereYear('claim_status.created_at', '=', $req->year)
            ->whereMonth('claim_status.created_at', '=', $i)->sum('claims.rec_amt');


        $partial = Claim::join('claim_status', 'claim_status.claim_id', '=', 'claims.id')
            ->where('claims.company_id', $req->company)->where('claim_status.status', 4)->where('claim_status.update_by', $req->admin)
            ->select('claim_status.created_at')->whereYear('claim_status.created_at', '=', $req->year)
            ->whereMonth('claim_status.created_at', '=', $i)->count();


        $partailamt = Claim::join('claim_status', 'claim_status.claim_id', '=', 'claims.id')
            ->where('claims.company_id', $req->company)->where('claim_status.status', 4)->where('claim_status.update_by', $req->admin)
            ->select('claim_status.created_at')->whereYear('claim_status.created_at', '=', $req->year)
            ->whereMonth('claim_status.created_at', '=', $i)->sum('claims.rec_amt');


        $transfermor = Claim::join('claim_status', 'claim_status.claim_id', '=', 'claims.id')
            ->where('claims.company_id', $req->company)->where('claim_status.status', 5)->where('claim_status.update_by', $req->admin)
            ->select('claim_status.created_at')->whereYear('claim_status.created_at', '=', $req->year)
            ->whereMonth('claim_status.created_at', '=', $i)->count();


        $transfermoramt = Claim::join('claim_status', 'claim_status.claim_id', '=', 'claims.id')
            ->where('claims.company_id', $req->company)->where('claim_status.status', 5)->where('claim_status.update_by', $req->admin)
            ->select('claim_status.created_at')->whereYear('claim_status.created_at', '=', $req->year)
            ->whereMonth('claim_status.created_at', '=', $i)->sum('claims.rec_amt');



        $transferlaw = Claim::join('claim_status', 'claim_status.claim_id', '=', 'claims.id')
            ->where('claims.company_id', $req->company)->where('claim_status.status', 6)->where('claim_status.update_by', $req->admin)
            ->select('claim_status.created_at')->whereYear('claim_status.created_at', '=', $req->year)
            ->whereMonth('claim_status.created_at', '=', $i)->count();


        $transferlawamt = Claim::join('claim_status', 'claim_status.claim_id', '=', 'claims.id')
            ->where('claims.company_id', $req->company)->where('claim_status.status', 6)->where('claim_status.update_by', $req->admin)
            ->select('claim_status.created_at')->whereYear('claim_status.created_at', '=', $req->year)
            ->whereMonth('claim_status.created_at', '=', $i)->sum('claims.rec_amt');

        $closed = Claim::join('claim_status', 'claim_status.claim_id', '=', 'claims.id')
            ->where('claims.company_id', $req->company)->where('claim_status.status', 10)->where('claim_status.update_by', $req->admin)
            ->select('claim_status.created_at')->whereYear('claim_status.created_at', '=', $req->year)
            ->whereMonth('claim_status.created_at', '=', $i)->count();


        $closedamt = Claim::join('claim_status', 'claim_status.claim_id', '=', 'claims.id')
            ->where('claims.company_id', $req->company)->where('claim_status.status', 10)->where('claim_status.update_by', $req->admin)
            ->select('claim_status.created_at')->whereYear('claim_status.created_at', '=', $req->year)
            ->whereMonth('claim_status.created_at', '=', $i)->sum('claims.rec_amt');

        // }
        $post = [
            $register, $registeramt, $collected, $colllectedamt, $delay, $delayamt, $partial, $partailamt, $transfermor, $transfermoramt,
            $transferlaw, $transferlawamt, $closed, $closedamt, $directpay, $directamt, $totalamount
        ];
        //dd($post);
        return response()->json($post, 200);
    }
    ////////end monthly claim status///////////



    /////////claim aging///////////////
    public function claimAgingInfo(Request $req)
    {


        $claims = array();
        $amount = array();
        $years = array();
        // dd($req->syear,$req->eyear,);
        for ($i = $req->syear; $i <= $req->eyear; $i++) {


            $claims[$i] = Claim::where('is_assign', $req->admin)->where('company_id', $req->company)
                ->select('created_at')->whereYear('created_at', $i)->count();
            $amount[$i] = Claim::where('is_assign', $req->admin)->where('company_id', $req->company)
                ->select('created_at')->whereYear('created_at', $i)->sum('rec_amt');
            array_push($years, $i . '(' . $claims[$i] . ')');
        }


        $post = [$amount, $years];

        return response()->json($post, 200);
    }
    /////////end claim aging//////////


    //payment vocher
    public function paymentVocher($id)
    {
        $claim = Claim::where('id', $id)->select('id', 'claim_no', 'deb_name', 'rec_amt', 'acc_date', 'deb_type', 'company_id')->first();
        $rec_amt = $claim->amount_after_discount;

        $amt_paid = payment::where('claim_id', $id)->where('response_code', 000)->sum('amount');
        $collected = CollectedClaim::where('claim_id', $id)->first();
        // dd($amt_paid);
        if ($amt_paid) {
            $rem_amt = $rec_amt - $amt_paid;
            $method = 'Online';
            return view('paymentvocher', compact('rem_amt', 'amt_paid', 'claim', 'method'));
        } else if ($collected) {

            $rem_amt = 0;
            $method = $collected->payment;
            $amt_paid = $claim->amount_after_discount;
            return view('paymentvocher', compact('rem_amt', 'amt_paid', 'claim', 'method'));
        } else {
            return "No Payment Yet";
        }
    }

    public function eleMsg($claimid)
    {
        $claim = Claim::where('id', $claimid)->first();
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
                                    'Value' => 'www.recovery.taheiya.sa/' . '/bit.ly/' . $claim->link,
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
                $elm->iqama = '';
                $elm->sms_description = '';
                $elm->save();



                session()->put('success', 'Message Sent');
                return back();
            } catch (SoapFault $fault) {
                session()->put('fail', 'Something went wrong');
                return back();
                // trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
            }
            session()->put('success', 'Message Sent');
            return back();
        } catch (\Exception $e) {
            // dd($e);
            session()->put('danger', 'Fail to send sms');
            return back();
        }
    }

    public function companyDoc(Request $req)
    {
        // dd($req->all());
        try {
            $claim = Claim::where('id', $req->claimid)->first();
            if ($req->hasfile('addFile')) {
                foreach ($req->file('addFile') as $file) {
                    $doc = new IcDoc;
                    $ran = rand(3, 9999);
                    $name = time() . $ran . '.' . $file->getClientOriginalExtension();
                    $filepath = 'claims/' . $claim->id . '/company/' . $claim->cid . '/AdditionalDoc/';
                    $file->move(storage_path() . '/app/public/' . $filepath, $name);
                    $doc->document = $filepath . $name;
                    $doc->claim_id = $claim->id;
                    $doc->status = 1;
                    $doc->added_by = Auth::user()->id;
                    $doc->save();
                }
            }
            return back()->with('success', 'Additional uploaded successfully');
        } catch (\Exception $e) {
            //dd($e);
            return back()->with('error', 'Something went wrong');
        }
    }

    public function customSadad(Request $req)
    {
        //dd('dfdf');
        try {

            $check = custompartialsadadLink($req->claimid, $req->amt);
            //dd($check);
            if ($check != 604 || $check != 504) {

                return back()->with('success', 'Sadad Invoice Send Successfully');
            } else {
                dd($e);
                return back()->with('error', 'Something went wrong');
            }
        } catch (\Exception $e) {
            dd($e);
            return back()->with('error', 'Something went wrong Tech');
        }
    }

    //partial manual collection
    public function partialManual(Request $req)
    {
        try {
            // $manual = new PartialManual;
            // $manual->claim_id = $partial->claim_id;
            // $manual->partial_id = $partial->id;
            // $manual->update_by = Auth::user()->id;
            // $manual->amount = $req->amount;
            // $manual->date =  str_replace('T', ' ', $req->cdate);
            // $manual->remark = $req->remark;
            // $manual->save();

            $date_time =  str_replace('T', ' ', $req->cdate);

            PartialPay::where('id', $req->partial_pay_id)->update([
                'date_time' => $date_time,
                'status' => PartialPayStatus::MANUAL_PAID->value,
                'recovered_date' => now(),
            ]);

            $upcommingInstallment = PartialPay::where('claim_id', $req->claim_id)
                ->where('status', PartialPayStatus::UPCOMMING->value)
                ->orderBy('installment')
                ->first();

            if ($upcommingInstallment) {
                PartialPay::where('id', $upcommingInstallment->id)->update([
                    'status' => PartialPayStatus::ACTIVE->value,
                ]);
            }

            // Alert::success('success', 'Collection Added Successfully');
            return back()->with('success', 'Manual Collection Added Successfully');
        } catch (\Exception $e) {
            // Alert::error('Error', 'Something went wrong');
            return back()->with('error', 'Something went wrong');
        }
    }
    public function partialDetail()
    {

        $partials = Claim::join('claim_status', 'claim_status.claim_id', '=', 'claims.id')
            ->where('claim_status.status', 4)->select('claims.id', 'claims.rec_amt')
            ->with('partialPaymentRe', 'additionalLinks', 'sadadPayment', 'additionalSadadLinks', 'manualPartial')
            ->orderBy('claims.id', 'asc')
            ->get();
        return view('admin.partialstatus', compact('partials'));
    }

    public function icPartialDetail()
    {

        $partials = Claim::join('claim_status', 'claim_status.claim_id', '=', 'claims.id')
            ->where('claim_status.status', 4)->where('claims.company_id', Auth::user()->company_id)->select('claims.id', 'claims.rec_amt')
            ->with('partialPaymentRe', 'additionalLinks', 'sadadPayment', 'additionalSadadLinks', 'manualPartial')
            ->orderBy('claims.id', 'asc')
            ->get();
        return view('ic.partialstatus', compact('partials'));
    }

    public function loginOTP(Request $req)
    {

        $email = $req->email;
        $otp = $req->otp;

        $user = User::where('email', $email)->first();

        if ($user->otp == $otp) {
        } else {
        }
    }

    public function twofactor(Request $req)
    {
        // dd($req->all());
        $user = User::where('id', $req->user_id)->first();
        if ($req->twofac != null) {
            $user->twofactor = 1;
            $user->save();
            return back()->with('success', 'Two Factor Applied');
        } else {
            $user->twofactor = 0;
            $user->save();
            return back()->with('success', 'Two Factor Removed');
        }
    }

    public function verifyOtp(Request $req)
    {
        // Validate the OTP entered by the user (You need to implement this part)
        $email = $req->email;
        $otp = $req->otp;

        $user = User::where('email', $email)->first();

        if ($user->otp == $otp) {

            $user->verifyotp = 1;
            $user->save();

            if (Auth::user()->roll == 0) {
                session()->put('success', 'Login Successful');
                return redirect()->route('AdminDashboard');
            } else if (Auth::user()->roll == 1) {

                if (Auth::user()->status == 0) {
                    session()->put('error', 'Waiting for admin approval');
                    return redirect()->route('IcSignInForm');
                } elseif (Auth::user()->status == 1) {
                    session()->put('success', 'Login Successful');
                    return redirect()->route('IcDashboard');
                }
            } else if (Auth::user()->roll == 2) {
                if (Auth::user()->status == 0) {
                    session()->put('error', 'Waiting for admin approval');
                    return redirect()->route('LfSignin');
                } elseif (Auth::user()->status == 1) {
                    session()->put('success', 'Login Successful');
                    return redirect()->route('Lfdashboard');
                }
            } else if (Auth::user()->roll == 3) {
                if (Auth::user()->status == 0) {
                    session()->put('error', 'Waiting For Approval');
                    return redirect()->route('fclogin');

                    return  "hello";
                } else if (Auth::user()->status == 1) {
                    session()->put('success', 'Log in Successfully');
                    return redirect()->route('fcdashboard');
                }
            } else if (Auth::user()->roll == 10) {
                session()->put('success', 'Log in Successfully');
                return redirect()->route('specialdashboard');
            }
        } else {

            return back();
        }


        // Redirect the user to the desired page after successful login
        //return redirect()->intended('/')->withCookie($cookie);
    }

    public function followStatus(Request $req)
    {
        DB::beginTransaction();
        try {


            $count = ClaimStatus::where('claim_id', $req->claimid)->count();
            $claimstatus = ClaimStatus::where('claim_id', $req->claimid)->first();
            $claim = Claim::where('id', $req->claimid)->first();
            if ($count == 0) {
                $claimstatus = new ClaimStatus();
                $claimstatus->claim_id = $req->claimid;
                $claimstatus->status = 1;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 1, Auth::user()->id);
            } else {
                $claimstatus->status = 1;
                $claimstatus->update_by = Auth::user()->id;
                $claimstatus->save();
                statusHistory($req->claimid, 1, Auth::user()->id);
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

            $collected = CollectedClaim::where('claim_id', $req->claimid)->get();
            if ($collected) {
                // $collected->each->delete();
                CollectedClaim::where('claim_id', $req->claimid)
                    ->update(['status' => 5]);
            }

            if ($req->statusreason != null) {
                $reason = new ClaimReason;
                $reason->claim_id = $req->claimid;
                $reason->update_by = Auth::user()->id;
                $reason->reason = $req->statusreason;
                $reason->status = 1;
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

    public function customPartial($id)
    {

        $partialPay = PartialPay::where('id', $id)->first();
        $claim = Claim::where('id', $partialPay->claim_id)->first();
        if ($partialPay->type == 'sadad') {
            $result =  customizedpartialsadadLink($partialPay->id);
            if ($result != 604 || $result != 504) {

                return back()->with('success', 'Sadad Invoice Send Successfully');
            } else {
                // dd($e);
                return back()->with('error', 'Something went wrong');
            }
        } else {
            if ($partialPay->amount == null) {
                $installment = PartialPay::where('claim_id', $partialPay->id)->where('status', '<>', 5)->count();
                $amount = $claim->amount_after_discount / $installment;
            } else {
                $amount = $partialPay->amount;
            }

            try {
                $claim = Claim::where('id', $partialPay->claim_id)->first();
                $idorder = 'PHP_' . rand(1, 1000); //Customer Order ID
                $terminalId = env('URWAYS_TERMINAL'); // Will be provided by URWAY
                $password = env('URWAYS_PASSWORD'); // Will be provided by URWAY
                $merchant_key = env('URWAYS_MERCHANT'); // Will be provided by URWAY
                $currencycode = "SAR";

                // $amount = $req->amount;


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
                    "udf2"              => route('PartialCustomerPayLink'), //Response page URL 'PaymentResponsePage'
                    "udf3"              => "",
                    "udf4"              => "",
                    "udf5"              => "Test5",
                    "claim_id"              => $claim->id,
                    'requestHash' => $hash  //generated Hash


                ]);
                $data = json_decode($response->getBody(), true);

                $url =  $data['targetUrl'] . '?paymentid=' .   $data['payid'];


                $paymentLink = new CustomPartialMada;
                $paymentLink->partial_id = $id;
                $paymentLink->claim_id = $claim->id;
                $paymentLink->link = $url;
                $paymentLink->amount = $amount;
                $paymentLink->payment_id = $data['payid'];
                $paymentLink->status = 1;
                $paymentLink->save();

                // $partialPay->link = $url;
                // $partialPay->pay_id = $data['payid'];
                // $partialPay->save();

                return back()->with('success', 'link generated successfully');
            } catch (\Exception $e) {
                dd($e);
                return back()->with('error', 'Something went wrong');
            }
        }
    }


    public function claimReason(Request $req)
    {
        $reason = new ClaimReason;
        $reason->claim_id = $req->claimid;
        $reason->update_by = Auth::user()->id;
        $reason->reason = $req->comment;
        $reason->status = 1;
        $reason->save();
        return back()->with('success', 'Reason Added');
    }

    public function paymentlinkCheck($id)
    {
        $sadad = SadadResponse::where('sadadNumber', $id)->first();
        if ($sadad != null) {
            return response()->json($sadad, 200);
        } else {

            $payment = payment::where('payment_id', $id)->first();
            return response()->json($payment, 200);
        }
    }


    public function registerClaim(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'officer_id' => 'required',
        ]);
        $claim = null;
        DB::transaction(function () use ($req, $claim) {
            $deb_type = 'third_party';
            $rec_reason = "";
            if ($req->deb_type == 'insured') {
                $deb_type = 'insured';
                $rec_reason = $req->rec_reason;
            }
            $claim = Claim::create([
                'cid' => Auth::user()->id,
                'company_id' => Auth::user()->company_id,
                'type' => $req->type,
                'claim_type' => $req->claim_type,
                'libpercent' => $req->libpercent,
                'amount_after_discount' => $req->rec_amt,
                'acc_date' => $req->acc_date,
                'acc_location' => $req->acc_location,
                'rec_amt' => $req->rec_amt,
                'deb_name' => $req->deb_name,
                'ic_mail' => $req->icemail,
                'deb_age' => $req->deb_age,
                'deb_iqama' => $req->deb_iqama,
                'claim_no' => $req->claim_no,
                'deb_mob' => '+966' . $req->deb_mob,
                'deb_type' => $deb_type,
                'rec_reason' => $rec_reason,
                'is_assign' => $req->officer_id,
            ]);

            $claimData = ClaimData::create([
                'claim_id' => $claim->id,
                'vehicle_type' => $req->vehicle_type,
                'vehicle_make' => $req->vehicle_make,
                'plate_no' => $req->plate_no,
                'remarks' => $req->remarks,
                'recovery_type' => $req->recovery_type,
                'accident_report_number' => $req->accident_report_number,
                'policy_no' => $req->policy_no,
                'loss_date' => $req->acc_date,
                'registration_date' => $req->registration_date,
                'sub_claim_no' => $req->sub_claim_no,
                'intimation_date' => $req->intimation_date,
                'policy_holder_liability' => $req->policy_holder_liability,
                'recovery_party_id' => $req->recovery_party_id,
                'recovery_party_name' => $req->recovery_party_name,
                'recovery_reserve_amount' => $req->recovery_reserve_amount,
                'recovery_request_date' => $req->recovery_request_date,
                'recovery_os_date' => $req->recovery_os_date,
                'recovery_close_date' => $req->recovery_close_date,
                'recovered_date' => $req->recovered_date,
                'recovered_amount' => $req->recovered_amount,
                'is_partial_recovered' => $req->is_partial_recovered,
                'assign_user_id' => $req->assign_user_id,
                'survey_number' => $req->survey_number,
            ]);
            if ($req->hasfile('support_doc')) {
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
            // claim added notifications
            if ($claim && $claimData) {
                $adminUsers = User::whereHasRole(['super-admin', 'manager', 'director', 'admin'])->get();
                $supervisors = User::whereHasRole(['supervisor'])->get();
                $officerName = auth()->user()->name;
                foreach ($adminUsers as $adminUser) {
                    Notification::create([
                        'from' => auth()->user()->id,
                        'to' => $adminUser->id,
                        'message' => "Claim (GGI00{$claim->id}) added by {$officerName}.",
                        'type' => 'New Claim Added',
                        'read' => false,
                        'link' =>  route('AdminClaimDetail', ['id' => $claim->id], false)
                    ]);
                }
                foreach ($supervisors as $supervisor) {
                    Notification::create([
                        'from' => auth()->user()->id,
                        'to' => $supervisor->id,
                        'message' => "Claim (GGI00{$claim->id}) added by {$officerName}.",
                        'type' => 'New Claim Added',
                        'read' => false,
                        'link' =>  route('supervisor.claim.detail', ['id' => $claim->id], false)
                    ]);
                }
                // dd($claim);
            }
        });
        // if (auth()->user()->hasRole(['admin', 'super-admin', 'director', 'manager'])) {
        //     return redirect()->route('AdminViewClaims')
        //         ->with('success', 'Claim Request Added SuccessFully');
        // } else if (auth()->user()->hasRole('employee')) {
        //     return redirect()->route('employee.claims')
        //         ->with('success', 'Claim Request Added SuccessFully');
        // }
        return back()->with('success', 'Claim Request Added SuccessFully');
    }

    public function updateClaim(Request $req)
    {
        // dd($req->all());
        // $req->validate([
        //     'deb_iqama' => 'required',
        //     'deb_mob' => 'required',
        //     'claim_id' => 'required',
        //     'claim_data_id' => 'required',
        // ]);

        DB::transaction(function () use ($req) {
            $deb_type = 'third_party';
            $rec_reason = "";

            if ($req->deb_type == 'insured') {
                $deb_type = 'insured';
                $rec_reason = $req->rec_reason;
            }

            Claim::where('id', $req->claim_id)->update([
                'cid' => Auth::user()->id,
                'company_id' => Auth::user()->company_id,
                'type' => $req->type,
                'claim_type' => $req->claim_type,
                'libpercent' => $req->libpercent,
                'amount_after_discount' => $req->rec_amt,

                'acc_date' => $req->acc_date,

                'acc_location' => $req->acc_location,
                'rec_amt' => $req->rec_amt,
                'deb_name' => $req->deb_name,
                'ic_mail' => $req->icemail,
                'deb_age' => $req->deb_age,
                'deb_iqama' => $req->deb_iqama,
                'claim_no' => $req->claim_no,
                'deb_mob' => '+966' . $req->deb_mob,
                'deb_type' => $deb_type,
                'rec_reason' => $rec_reason,
                'is_assign' => $req->officer_id,
                'our_responsipility_per' => $req->our_responsipility_per,
            ]);

            ClaimData::where('id', $req->claim_data_id)->update([
                'vehicle_type' => $req->vehicle_type,
                'vehicle_make' => $req->vehicle_make,
                'plate_no' => $req->plate_no,
                'remarks' => $req->remarks,
                'recovery_type' => $req->recovery_type,
                'accident_report_number' => $req->accident_report_number,
                'policy_no' => $req->policy_no,
                'loss_date' => $req->acc_date,
                'registration_date' => $req->registration_date,
                'our_responsipility_per' => $req->our_responsipility_per,
                'sub_claim_no' => $req->sub_claim_no,
                'intimation_date' => $req->intimation_date,
                'policy_holder_liability' => $req->policy_holder_liability,
                'recovery_party_id' => $req->recovery_party_id,
                'recovery_party_name' => $req->recovery_party_name,
                'recovery_reserve_amount' => $req->recovery_reserve_amount,
                'recovery_request_date' => $req->recovery_request_date,
                'recovery_os_date' => $req->recovery_os_date,
                'recovery_close_date' => $req->recovery_close_date,
                'recovered_date' => $req->recovered_date,
                'recovered_amount' => $req->recovered_amount,
                'is_partial_recovered' => $req->is_partial_recovered,
                'assign_user_id' => $req->assign_user_id,
            ]);

            if ($req->hasfile('support_doc')) {
                $claim = Claim::find($req->claim_id);

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

            // delete old files from frontend checkbox
            foreach ($req->deletable_docs ?? [] as $deletable_doc) {
                $supportedDoc = Supported_Doc::find($deletable_doc);
                File::delete(storage_path('/app/public/' . $supportedDoc->doc_name));
                $supportedDoc->delete();
            }
        });



        // commented by zeeshan sir
        // $admin = User::where('roll', 0)->first();
        // Notification::create([
        //     'from' => Auth::user()->id,
        //     'to' => $admin->id,
        //     'message' => 'New Claim Added',
        //     'type' => 'claim added',
        //     'read' => false,
        // ]);


        // if (auth()->user()->hasRole(['admin', 'super-admin', 'director', 'manager'])) {
        //     return redirect()->route('AdminViewClaims')
        //         ->with('success', 'Claim Request Added SuccessFully');
        // } else if (auth()->user()->hasRole('employee')) {
        //     return redirect()->route('employee.claims')
        //         ->with('success', 'Claim Request Added SuccessFully');
        // }
        return back()->with('success', 'Claim Request updated SuccessFully');
    }


    public function importExcel(Request $request)
    {
        // $xfile = $request->xfile;

        $file = $request->file('xfile');
        $header_values = []; // column names (claim_id,is_assign)
        $claims = []; // all claims data store in ti
        try {
            $xlsx = SimpleXLSX::parse($file); // extract data from excel file

            foreach ($xlsx->rows() as $key => $value) { // select rows form excel file
                if ($key === 0) { // first rows as header and convert into lowercase
                    $lowercase_header_names = array_map(function ($header_column_name) {
                        return strtolower($header_column_name);
                    }, $value);
                    $header_values = $lowercase_header_names;

                    continue;
                }
                $claims[] = array_combine($header_values, $value);
                // dd($claims);
            }
        } catch (Exception $e) {
            return SimpleXLSX::parseError();
        }


        foreach ($claims as $claimRow) {
            // dd($claimRow);
            if (Claim::where('claim_no', $claimRow['claim_no'])->count() > 0) {
                return redirect()->back()->with('error', 'Claim already exist!');
            } else {
                if ($claimRow['status'] == 'os') {
                    // dd($claimRow);
                    DB::transaction(function () use ($claimRow) {
                        // if($row->getCellAtIndex($columns['RESERVE_AMT'])?->getValue()){
                        $claim_id = Claim::insertGetId([
                            "cid" => Auth::user()->id,
                            "company_id" => null,
                            "rec_amt" => $claimRow['recovery_reserve_amount'], //RESERVE_AMT
                            "acc_date" => $claimRow['accident_date'], // ACCIDENT_DATE
                            "amount_after_discount" => $claimRow['recovery_reserve_amount'], //RESERVE_AMT
                            "acc_location" => $claimRow['claim_reg_branch'], //CITY
                            "deb_iqama" => $claimRow['recovery_party_id'], // DEB_IQAMA 
                            "deb_name" => $claimRow['recovery_party_name'], //RECOVEREE_NAME
                            "deb_mob" => null, //Mobile,
                            "claim_no" => $claimRow['claim_no'], //CLAIM_NO
                            "libpercent" => $claimRow['policy_holder_liability'], //OUR_RESPONSIPILITY_PER
                            'type' => $claimRow['recovery_type'],
                            "is_assign" => getUserIdByName($claimRow['assigned_user_name']),
                            'our_responsipility_per' => $claimRow['policy_holder_liability'],
                            "remarks" => $claimRow['remarks'], //REMARKS
                            'created_at' => date("Y-m-d"),
                            'updated_at' => date("Y-m-d")
                        ]);
                        $existClaims = ClaimData::insert([
                            'claim_id' => $claim_id,
                            'recovery_type' => $claimRow['recovery_type'], //RECOVERY_TYPE
                            'policy_no' => $claimRow['policy_number'], //POLICY_NO
                            'loss_date' => $claimRow['accident_date'], //LOSS_DATE
                            'registration_date' => null, //REGISTRATION_DATE
                            'vehicle_type' => null, //VEHICLE_TYPE
                            'vehicle_make' => null, //VEHICLE_MAKE
                            'plate_no' => null, //MT_PLATE_NO
                            'recovery_request_date' => null,
                            'survey_number' => $claimRow['survey_number'],
                            'intimation_date' => $claimRow['intimation_date'],
                            'recovery_os_date' => null,
                            'recovery_close_date' => null,
                            'recovered_date' => null,
                            'recovered_amount' => null,
                            'is_partial_recovered' => null,
                            'assign_user_id' => null,
                            'sub_claim_no' => null,
                            'policy_holder_liability' => null,
                            'recovery_party_id' => null,
                            'recovery_party_name' => null,
                            'recovery_reserve_amount' => null,
                        ]);
                    });
                }
            }
        }
        return redirect()->back()->with('success', 'Excel data imported successfully.');
    }

    // public function importexcel(Request $req)
    // {

    //     // return $req->data;
    //     // return $req->all()["data"];

    //     DB::beginTransaction();
    //     try {
    //         if ($req->hasfile('xfile')) {

    //             $size_of_array = sizeof($req->data);
    //             dd($size_of_array);
    //             $rows = $size_of_array / 43;
    //             $data = $req->all();
    //             $details = $data["data"];
    //             $col = 0;
    //             $i = 1;
    //             dd($rows);
    //             for ($item = 0; $item < $rows; $item++) {
    //                 $details[$col];
    //                 $details[$col + 1];
    //                 $details[$col + 2];
    //                 $details[$col + 3];
    //                 $details[$col + 4];
    //                 $details[$col + 5];
    //                 $details[$col + 6];
    //                 $details[$col + 7];
    //                 $details[$col + 8];
    //                 $details[$col + 9];
    //                 $details[$col + 10];
    //                 $details[$col + 11];
    //                 $details[$col + 12];
    //                 $date = $req->date;
    //                 $username = getUserIdByName($details[$col + 42]);

    //                 $claim[$item] = Claim::insertGetId([
    //                     "cid" => Auth::user()->id,
    //                     "company_id" => null,
    //                     "rec_amt" => $details[$col + 19], //RESERVE_AMT
    //                     "acc_location" => $details[$col + 10], //CITY
    //                     // "rec_reason" => $details[$col + 2],
    //                     // "deb_iqama" => $details[$col + 3],
    //                     "deb_name" => $details[$col + 23], //RECOVEREE_NAME
    //                     // "deb_age" => $details[$col + 5],
    //                     "deb_mob" => '+966' . $details[$col + 40], //Mobile
    //                     // "deb_type" => $details[$col + 7],
    //                     "claim_no" => $details[$col + 3], //CLAIM_NO
    //                     // "ic_mail" => $details[$col + 9],
    //                     // "acc_date" => $details[$col + 10],
    //                     "libpercent" => $details[$col + 21], //OUR_RESPONSIPILITY_PER
    //                     // "type" => $details[$col + 12],
    //                     "is_assign" => $username,
    //                     "remarks" => $details[$col + 24], //REMARKS
    //                     'created_at' => date("Y-m-d"),
    //                     'updated_at' => date("Y-m-d")

    //                 ]);

    //                 ClaimData::insert([
    //                     'claim_id' => $claim[$item],
    //                     'recovery_type' => $details[$col + 2], //RECOVERY_TYPE
    //                     'policy_no' => $details[$col + 4], //POLICY_NO
    //                     'loss_date' => $details[$col + 8], //LOSS_DATE
    //                     'registration_date' => $details[$col + 9], //REGISTRATION_DATE
    //                     'vehicle_type' => $details[$col + 11], //VEHICLE_TYPE
    //                     'vehicle_make' => $details[$col + 12], //VEHICLE_MAKE
    //                     'plate_no' => $details[$col + 13], //MT_PLATE_NO
    //                     // 'our_responsibility' => $details[$col + 20]
    //                 ]);

    //                 $col += 43;
    //             }
    //             session()->put('success', "Record inserted");
    //         }
    //         DB::commit();
    //         return back();
    //     } catch (\Exception $e) {
    //         dd($e);
    //         DB::rollback();
    //         return back()->with('error', 'Something went wrong');
    //     }
    // }



    ///////////////////////////////////
    ///////////////////////////////////

    //profile
    public function generalProfileSetting(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:60',
            'email' => 'required',
        ]);

        User::where('id', auth()->user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'age' => $request->age,
        ]);

        return back()->with('success', 'Admin Profile updated successfully.');
    }

    // register user
    public function registerUser(Request $request)
    {

        $request->validate([
            'name' => "required|min:3|max:60",
            'email' => "required|email|unique:users,email",
            'national_id' => "required",
            'password' => "required|min:8|max:30",
            'mobile_no' => "required",
            'roles' => "required"
        ]);



        // create method not work on [phone, reg_no] column, i meant, store null

        // $user = User::create([
        //     'name'=>$request->name,
        //     'email'=>$request->email,
        //     'reg_no'=>$request->national_id,
        //     'password'=>Hash::make($request->password),
        //     'phone'=>'+966'.$request->mobile_no,
        //     'status'=>1
        // ]);

        // $user->addRoles($request->roles);

        // return redirect()
        //     ->route('admin.all-users-list')
        //     ->with('success','User added successfully');

        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->reg_no = $request->national_id;
            $user->password = Hash::make($request->password);
            $user->phone = '+966' . $request->mobile_no;
            $user->additional_phone = '+966' . $request->additional_phone;
            $user->status = 1;
            $user->roll = 0;
            $user->is_super = 0;
            $user->save();

            $user->addRoles($request->roles);

            return redirect()
                ->route('admin.all-users-list')
                ->with('success', 'User added successfully');
        } catch (\Exception $e) {

            return back()->with('error', 'Something went wrong');
        }
    }
    public function editUser(Request $request)
    {

        $request->validate([
            'user_id' => "required",
            'name' => "required|min:3|max:60",
            'email' => "required|email",
            'national_id' => "required",
            // 'password' => "required|min:8|max:30",
            'mobile_no' => "required",
            // 'roles' => "required"
        ]);



        try {

            $user = User::where('id', $request->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'reg_no' => $request->national_id,
                'phone' => '+966' . $request->mobile_no,
                'additional_phone' => '+966' . $request->additional_phone,
                'status' => 1,
            ]);

            if ($request->password) {
                User::where('id', $request->user_id)->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            if (!$request->queryRole) {

                // remove old roles from user
                $user = User::with('roles')->firstWhere('id', $request->user_id);

                $userCurrentRoles = [];

                foreach ($user->roles as $role) {
                    $userCurrentRoles[] = $role->name;
                }

                $user->removeRoles($userCurrentRoles);

                // add new role from request form
                $user->addRoles($request->roles ?? []);
            }


            return back()
                ->with('success', 'User updated successfully');
        } catch (\Exception $e) {

            return back()->with('error', 'Something went wrong');
        }
    }


    /**************************************
     * FOLLWOING METHODS ARE PASTED HERE FROM (admin.php) routes file
     * means all following methods are closures from admin.php file
     *
     * e.g.
     * Route::get('some-url',function(){})
     * into
     * Route::get('some-url',[SomeController::class, 'someUrl'])
     */

    public function adminDashboard()
    {
        $link = Claim::where('status', 1)->get();
        return view('admin.dashboard', compact('link'));
    }

    public function objection()
    {

        if (Auth::user()->company_id != null) {
            $objection = DebtorResponse::join('claims', 'debtorresponses.claim_id', '=', 'claims.id')
                ->where('claims.company_id', Auth::user()->company_id)->where('debtorresponses.response', 1)
                ->where('debtorresponses.obj_status', null)->get();
            return view('admin.callsmsresponses', compact('objection'));
        } else {
            $objection = DebtorResponse::where('response', 1)->where('obj_status', null)->get();
            return view('admin.callsmsresponses', compact('objection'));
        }

        // $objection=DebtorResponse::where('response',1)->where('obj_status',null)->get();
        // return view('admin.callsmsresponses',compact('objection'));

    }

    public function viewLawFirm()
    {
        $lawfirms = User::where(['roll' => 2,])->get();
        return view('admin.viewlawfirms', compact('lawfirms'));
    }

    public function viewLoanAcceptLoanRequest()
    {
        $loan = Loan::where('status', 1)->get();
        return view('admin.viewacceptloan', compact('loan'));
    }

    public function viewLoanRejectedLoanRequest()
    {
        $loan = Loan::where('status', 2)->get();
        return view('admin.viewrejectloan', compact('loan'));
    }

    public function deactiveUser($id)
    {
        $user = User::where('id', $id)->first();
        $user->status = 1;
        $user->save();
        return back()->with('success', 'User Active Successfully');
    }

    public function activeUser($id)
    {
        $user = User::where('id', $id)->first();
        $user->status = 0;
        $user->save();
        return back()->with('success', 'User De-Active Successfully');
    }

    public function addAdminStaffView()
    {
        return view('admin.adminstaff');
    }

    public function adminList()
    {
        $users = User::where('roll', 0)->get();
        return view('admin.admin_list', compact('users'));
    }

    public function checkCall()
    {

        if (Auth::user()->company_id != null) {
            $response = CallStatus::join('claims', 'call_status.claim_id', '=', 'claims.id')
                ->where('claims.company_id', Auth::user()->company_id)
                ->paginate(20);
            // dd($response[0]->call_status->status);

            return view('admin.callstatus', compact('response'));
        } else {
            $response = CallStatus::paginate(20);
            return view('admin.callstatus', compact('response'));
        }
    }

    public function partialPayList()
    {
        $partial = PartialPay::all();
        return view('admin.partial_list', compact('partial'));
    }

    public function deleteDoc($id)
    {
        try {
            $doc = AdminDoc::where('id', $id)->first();
            $doc->delete();
            return back()->with('success', 'Deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function gigReport()
    {
        $claims = Claim::where('company_id', 3)->with('statusee')->select('id', 'acc_date', 'rec_amt', 'created_at', 'status', 'claim_no', 'deb_type')->paginate(10);
        return view('admin.gigreport', compact('claims'));
    }

    public function adminRec(Request $req)
    {
        $year = $req->year;
        $directEveryMonth = [];
        $mergedArray = [];
        $payment;
        for ($i = 1; $i <= 12; $i++) {
            // $direct = Claim::where('status',3)->whereYear('created_at',$year)->whereMonth('created_at',$i)->sum('rec_amt');

            $bankTransfer = DebtorBankTransfer::join('claims', 'claims.id', '=', 'debtor_bank_transfers.claim_id')
                ->whereYear('debtor_bank_transfers.created_at', $year)->whereMonth('debtor_bank_transfers.created_at', $i)
                ->where('debtor_bank_transfers.status', 2)->where('claims.is_assign', $req->userId)
                ->get();

            $partialManual = PartialManual::join('claims', 'claims.id', '=', 'partial_manual.claim_id')
                ->whereYear('partial_manual.created_at', $year)->whereMonth('partial_manual.created_at', $i)
                ->where('claims.is_assign', $req->userId)
                ->get();


            //  $directEveryMonth[$i] =  array_merge($payment->toArray(), $sadad->toArray() , $partialManual->toArray());
            $dataByMonth[$i] = [
                'payment' => $bankTransfer,
                'partialManual' => $partialManual
            ];
        }


        return view('admin.recoveryDetail', compact('dataByMonth'));
    }

    public function collectedClaim()
    {

        $year = 2023;
        $directEveryMonth = [];
        $mergedArray = [];
        $payment;
        for ($i = 1; $i <= 12; $i++) {
            // $direct = Claim::where('status',3)->whereYear('created_at',$year)->whereMonth('created_at',$i)->sum('rec_amt');

            $bankTransfer = DebtorBankTransfer::join('claims', 'claims.id', '=', 'debtor_bank_transfers.claim_id')
                ->whereYear('debtor_bank_transfers.created_at', $year)->whereMonth('debtor_bank_transfers.created_at', $i)
                ->where('debtor_bank_transfers.status', 2)
                ->get();
            $partialManual = PartialManual::join('claims', 'claims.id', '=', 'partial_manual.claim_id')
                ->whereYear('partial_manual.created_at', $year)->whereMonth('partial_manual.created_at', $i)->get();
            //  $directEveryMonth[$i] =  array_merge($payment->toArray(), $sadad->toArray() , $partialManual->toArray());
            $dataByMonth[$i] = [
                'payment' => $bankTransfer,
                'partialManual' => $partialManual
            ];
        }
        return view('admin.recoveryDetail', compact('dataByMonth'));
    }

    // added by talha
    public function sendBackToSV(Request $req)
    {
        $data = $req->all();
        $claim = DB::table('claim_status')->where('claim_id', $data['claim_id'])->first();
        if (empty($claim)) {
            ClaimStatus::create([
                'claim_id' => $data['claim_id'],
                'status' => ClaimStatusEnum::SEND_BACK_TO_SUPERVISOR->value,
                'update_by' => Auth::user()->id
            ]);
            session()->put('success', 'Claim send back to Supervisor successfull!');
            return redirect()->back();
        }
    }


    public function requestChangeStatusList()
    {
        $requests = RequestChangeStatusModel::all();
        return view('admin.requestChangeStatus', compact('requests'));
    }

    public function approveRequestStatusChange($claim_id)
    {
        if (!empty($claim_id)) {
            $updateStatus =  Claim::where('id', $claim_id)->update([
                'status' => 1,
            ]);
            if ($updateStatus) {
                $removeRequest = RequestChangeStatusModel::where('claim_id', $claim_id)->delete();
                if($removeRequest){
                    ClaimStatus::where('claim_id',$claim_id)->delete();
                    session()->put('success', 'Request to change status approve successfully!');
                    return redirect()->back();
                }
            }
        }
    }
}
