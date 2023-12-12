<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use SoapClient;
use App\Models\Loan;
use App\Models\Claim;
use App\Models\CallStatus;
use App\Models\SmsResponse;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\DebtorResponse;
use CodeDredd\Soap\Facades\Soap;
use App\Models\DebtorRefuseReason;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class DebtorResponseController extends Controller
{


    public function debtorobj(Request $req){
        $res=DebtorResponse::where('claim_id',$req->claim_id)->where('obj_status',null)->count();
        if($res >=1 ){
            Alert::warning('Not Allow', 'Your last objection still in consideration');
            return back();
        }
        else{
            $response = new DebtorResponse;
            $response->claim_id= $req->claim_id;
            $response->response=1;
            $response->objection=$req->objection;
             $response->deb_mob=$req->deb_mob;
            $response->save();
            Alert::success('Success', 'Your Objection Added');
           return back();
        }

    }



      public function valid(Request $req)
    {


            if($req->objection==1){
                $response = DebtorResponse::where('claim_id',$req->claim_id)->first();
                $response->obj_status=1;
               $claim=Claim::where('id',$req->claim_id)->first();
               $email=getEmail($claim->cid);
                try{
                    $details=[
                        'claimId'=>$req->claim_id,
                    ];
                    \Mail::to($email)->send(new \App\Mail\ValidObjMail($details));
                    $response->save();
                    return back()->with('success','Case Transfer To Company');
                }catch(\Exception $e){
                   // dd($e);
                    return back()->with('error','Try Again something went wrong');
                }


            }else if($req->objection==0){


             //   \Mail::to('zeeshannazir804@gmail.com')->send(new \App\Mail\ValidObjMail($details));

                $response = DebtorResponse::where('claim_id',$req->claim_id)->first();
                $response->obj_status=0;
                //$response->save();
                return redirect()->route('EditAdminClaim',$req->claim_id);



            }



    }

    public function invalid($id,Request $req){
        $response = DebtorResponse::where('id',$id)->first();


        $recieverNumber=getclaimbyid($response->claim_id)->deb_mob;
        $cid=getclaimbyid($response->claim_id)->cid;
        $claim=Claim::where('id',$response->claim_id)->first();
        // $companyname=getCompanyById($claim->company_id)->name;
        $companyname='Al Rajhi Takaful';
       // $companyname=getCompanyById(getclaimbyid($response->claim_id)->companYYid)->name;
        $rec_amt=getclaimbyid($response->claim_id)->amount_after_discount;
        $link=$req->getSchemeAndHttpHost().'/bit.ly/'.getclaimbyid($response->claim_id)->link;
        $reciever=$claim->deb_mob;

       // $message1="Your objection about claim".$response->claim_id." for the company of " .$companyname."has been rejected. Hence you  should pay the due before your credit history is affected.For more detail visit the given link ".$link;
        $message2=   "عزيزي العميل نفيدكم بأن اعتراضكم على المطالبة رقم".$response->claim_id." لدى الشركة".$companyname."تم رفضه لذا نرجو المبادرة بسداد المبلغ ";
        try{

                adminSendMessage($reciever,$message2,$claim->id);
                 $response->obj_status=0;
                $response->save();
        return back()->with('success','Invalid Successfully');
        }catch(\Exception $e){
            return back()->with('error','Something went wrong');
        }

    }
    //company invalid the objection
    public function icinvalid($id){
        $response = DebtorResponse::where('claim_id',$id)->first();
        $response->obj_status=4;
        $response->save();
        return back()->with('success','Invalid Successfully');
    }

    //compnay case close valid objection
    public function icvalid($id){
        $response = DebtorResponse::where('claim_id',$id)->first();
        $response->obj_status=3;
        $response->save();
        return back()->with('success','Valid Successfully');
    }


    //deb refuse to pay
    // public function debrefuse($id){
    //     $exist=DebtorResponse::where('claim_id',$id)->first();
    //     if($exist){
    //         Alert::success('Cannot Save', 'You Already Register Your Response');
    //         return back();
    //     }else{
    //         $res = new DebtorResponse;
    //         $res->claim_id =$id;
    //         $res->response=2;
    //         Alert::warning('Refused', 'Successfully Refuseed');
    //         $res->save();
    //         return back()->with('success','You refused Successfully');
    //     }

    // }
    public function debrefuse(Request $req){
        $exist=DebtorResponse::where('claim_id',$req->claim_id)->first();
        if($exist){
            Alert::success('Cannot Applied', 'You Already Register Your Response');
            return back();
        }else{
            $res = new DebtorResponse;
            $res->claim_id =$req->claim_id;
            $res->response=2;
            $res->save();
            $debres = new DebtorRefuseReason;
            $debres->debtorresponses_id= $res->id;
            $debres->claim_id= $req->claim_id;
            if($req->refuseres == null){
                $debres->reason= "Not give any reason";
            }else{
                $debres->reason= $req->refuseres;
            }

            $debres->save();
            Alert::warning('Refused', 'Successfully Refuseed');

            return back()->with('success','You refused Successfully');
        }

    }

    // laon applied
    public function loan(Request $req,$id){
       // dd($req->all);

       $check=DebtorResponse::where('claim_id',$id)->first();
       if($check==null){
        $response=new DebtorResponse;
        $response->claim_id=$id;
        $response->response=4;
        $response->save();
        Alert::success('Applied', 'Successfully Applied Wait For Response');
        return back()->with('success','You applied for loan successfully');
       }else{
        Alert::success('Cannot Applied', 'You Already Register Your Response');
        return back();
       }


        // $loan=new Loan;
        // $loan->claim_id=$claim;
        // $loan->company_id=$fcom;
        // $loan->status=0;
        // $loan->save();

        //      $notification= Notification::create([
        //     'from'=>Auth::user()->id,
        //     'to'=>$fcom,
        //     'message'=>'New Loan Assigned',
        //     'type'=>'Loan',
        //     'read'=>false,
        // ]);


    }

    public function validObjection() {

        $objection = DebtorResponse::where('response', 1)->where('obj_status', 1)->get();
        return view('admin.validobjections', compact('objection'));
    }

    public function invalidObjection() {
        if (Auth::user()->company_id != null) {
            $objection = DebtorResponse::join('claims', 'debtorresponses.claim_id', '=', 'claims.id')
                ->where('claims.company_id', Auth::user()->company_id)->where('debtorresponses.response', 1)
                ->where('debtorresponses.obj_status', 0)->get();
            return view('admin.invalidobjections', compact('objection'));
        } else {
            $objection = DebtorResponse::where('response', 1)->where('obj_status', 0)->get();
            return view('admin.invalidobjections', compact('objection'));
        }
        // $objection=DebtorResponse::where('response',1)->where('obj_status',0)->get();
        // return view('admin.invalidobjections',compact('objection'));

    }

    public function companyValidObjection() {
        if (Auth::user()->company_id != null) {
            $objection = DebtorResponse::join('claims', 'debtorresponses.claim_id', '=', 'claims.id')
                ->where('claims.company_id', Auth::user()->company_id)->where('debtorresponses.response', 1)
                ->where('debtorresponses.obj_status', 4)->get();
            return view('admin.companyobjections', compact('objection'));
        } else {
            $objection = DebtorResponse::where('response', 1)->where('obj_status', 4)->get();
            return view('admin.companyobjections', compact('objection'));
        }
        // $objection =DebtorResponse::where('response',1)->where('obj_status',4)->get();
        // return view('admin.companyobjections',compact('objection'));
    }

    public function caseCloseObjection() {
        $objection = DebtorResponse::where('response', 1)->where('obj_status', 3)->get();
        return view('admin.casecloseobjections', compact('objection'));
    }

    public function makecall($id)
    {
        $claim = Claim::where('id', $id)->first();

        initiateCall($claim->deb_mob);
        session()->put('success', 'Call Initiate Successfully');
        return back()->with('success', 'Call Initiate Successfully');
    }

    public function refuseResponse() {
        if (Auth::user()->company_id != null) {
            $response = DebtorResponse::join('claims', 'debtorresponses.claim_id', '=', 'claims.id')
                ->where('claims.company_id', Auth::user()->company_id)->where('debtorresponses.response', 2)->get();

            return view('admin.refuseresponse', compact('response'));
        } else {
            $response = DebtorResponse::where('response', 2)->get();
            return view('admin.refuseresponse', compact('response'));
        }
    }
    public function checkCallStatus() {
        $response = CallStatus::all();
        return view('admin.callstatus', compact('response'));
    }

    public function callAgain($claimid)
    {

        $recieverNumber = getPhoneNumber($claimid);
        //dd($recieverNumber);
        try {
            $response = json_decode(callufone($recieverNumber));
            //dd( $response);
            // dd($response->callId,$response->referenceId);
            $callexit = CallStatus::where('claim_id')->count();
            if ($callexit > 0) {

                $callexit->claim_id = $claimid;
                $callexit->callId = $response->callId;
                $callexit->referenceId = $response->referenceId;
                $callexit->save();
                $claim->save();
                session()->put('success', 'Claim Status Changed');
                return redirect()->route('AdminViewClaims');
            } else {

                $callexit1 = new CallStatus();
                $callexit1->claim_id = $claimid;
                $callexit1->callId = $response->callId;
                $callexit1->referenceId = $response->referenceId;
                $callexit1->save();


                session()->put('success', 'Call Initiated Successfully');
                return redirect()->route('AdminViewClaims');
            }
        } catch (\Exception $e) {
            //dd($e);
            session()->put('danger', 'Fail can not call');
            return redirect()->route('AdminViewClaims');
        }
    }

    public function viewLoanRequests() {
        if (Auth::user()->company_id != null) {
            $loan = DebtorResponse::join('claims', 'debtorresponses.claim_id', '=', 'claims.id')
                ->where('claims.company_id', Auth::user()->company_id)->where('debtorresponses.response', 4)->get();
            return view('admin.viewloanreq', compact('loan'));
        } else {
            $loan = DebtorResponse::where('response', 4)->get();
            return view('admin.viewloanreq', compact('loan'));
        }
        // $loan=DebtorResponse::where('response',4)->get();
        // return view('admin.viewloanreq',compact('loan'));
    }

    public function smsResponse() {

        if (Auth::user()->company_id != null) {
            $smsres = SmsResponse::join('claims', 'sms_response.claim_id', '=', 'claims.id')->where('company_id', Auth::user()->company_id)->paginate(20);
            return view('admin.smsresponse', compact('smsres'));
        } else {
            $smsres = SmsResponse::paginate(20);
            return view('admin.smsresponse', compact('smsres'));
        }
    }

    public function reSendMessage($claimid,$id)
    {

        try {

            $claim = Claim::where('id', $claimid)->first();
            $reciever = $claim->deb_mob;
            $smsres = SmsResponse::where('id',$id)->first();
                $reciever = substr($reciever, 1);
            $message = $smsres->sms;
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

            return back()->with('success', 'SMS send successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'SMS Failed');
        }
    }

}
