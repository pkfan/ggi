<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\DebIvrResponse;
use App\Models\DebtorResponse;
use App\Models\payment;
use App\Models\PayDelay;
use App\Models\PartialPay;
use App\Models\SadadResponse;
use App\Models\SadadPay;
use App\Models\AdditionalSadad;
use App\Models\PaymentLink;
use Illuminate\Http\Request;
use \Carbon\Carbon;

class PaymentController extends Controller
{
    public function initPay(Request $req)
    {
        

        $idorder = 'PHP_' . rand(1, 1000);//Customer Order ID


        $terminalId = "taheiya";// Will be provided by URWAY
        $password = "taheiya@URWAY_753";// Will be provided by URWAY
        $merchant_key = "74f5a88215a11c1fd76fa7540b26c1562565c7ab19ebaee21c09063057c327fe";// Will be provided by URWAY
        $currencycode = "SAR";
        $amount = $req->amount;

        $claim=Claim::where('id',$req->claim_id)->first();
        $ic_email=$claim->ic_mail;
        if($ic_email==null){
             $ic_email='info@taheiya.sa';
        }





        $ipp = "127.0.0.1";

        //Generate Hash
        $txn_details= $idorder.'|'.$terminalId.'|'.$password.'|'.$merchant_key.'|'.$amount.'|'.$currencycode;
        $hash=hash('sha256', $txn_details);


        $fields = array(
            'trackid' => $idorder,
            'terminalId' => $terminalId,
            'customerEmail' => $ic_email,
            'action' => "1",  // action is always 1
            'merchantIp' =>$ipp,
            'password'=> $password,
            'currency' => $currencycode,
            'country'=>"SA",
            'amount' => $amount,
             "udf1"  =>"Test1",
        //            "udf2"              =>"https://urway.sa/urshop/scripts/response.php",//Response page URL
            "udf2"              =>route('PaymentResponsePage'),//Response page URL
            "udf3"              =>"",
            "udf4"              =>"",
            "udf5"              =>"Test5",
            "claim_id"              =>$req->claim_id,
            'requestHash' => $hash  //generated Hash
        );
       
        $data = json_encode($fields);
         //dd($data);
        $ch=curl_init('https://payments.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest'); // Will be provided by URWAY
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $server_output =curl_exec($ch);
        //close connection
        curl_close($ch);
        $result = json_decode($server_output);
       
        if (!empty($result->payid) && !empty($result->targetUrl)) {
            $url = $result->targetUrl . '?paymentid=' .  $result->payid;
        //            header('Location: '. $url, true, 307);//Redirect to Payment Page
            return redirect()->to($url);
            
        }else{

           // print_r($result);
            echo "<br/><br/>";
            print_r($data);
            die();
        }

        $req->session()->forget('claim');
    }
    public function newinitPay(Request $req)
    {


         dd($req->all());
        $idorder = 'PHP_' . rand(1, 1000);//Customer Order ID


        $terminalId = "taheiya";// Will be provided by URWAY
        $password = "taheiya@123";// Will be provided by URWAY
        $merchant_key = "1442d566a7659976f3299dcb434378d24e73ce5f5dd53b9c4796ab36413b91b3";// Will be provided by URWAY
        $currencycode = "SAR";
        $amount = 5;







        $ipp = "127.0.0.1";

        //Generate Hash
        $txn_details= $idorder.'|'.$terminalId.'|'.$password.'|'.$merchant_key.'|'.$amount.'|'.$currencycode;
        $hash=hash('sha256', $txn_details);


        $fields = array(
            'trackid' => $idorder,
            'terminalId' => $terminalId,
            'customerEmail' => 'developer@taheiya.sa',
            'action' => "1",  // action is always 1
            'merchantIp' =>$ipp,
            'password'=> $password,
            'currency' => $currencycode,
            'country'=>"SA",
            'amount' => $amount,
            "udf1"              =>"Test1",
        //            "udf2"              =>"https://urway.sa/urshop/scripts/response.php",//Response page URL
            "udf2"              =>route('PaymentResponsePage'),//Response page URL
            "udf3"              =>"",
            "udf4"              =>"",
            "udf5"              =>"Test5",
            "claim_id"              =>5,
            'requestHash' => $hash  //generated Hash
        );
        $data = json_encode($fields);
        $ch=curl_init('https://payments-dev.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest'); // Will be provided by URWAY
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $server_output =curl_exec($ch);
        //close connection
        curl_close($ch);
        $result = json_decode($server_output);
        if (!empty($result->payid) && !empty($result->targetUrl)) {
            $url = $result->targetUrl . '?paymentid=' .  $result->payid;
        //            header('Location: '. $url, true, 307);//Redirect to Payment Page
            return redirect()->to($url);
        }else{

           // print_r($result);
            echo "<br/><br/>";
           // print_r($data);
            die();
        }
    }


    public function getPaymentResponse(Request $req)
    {
        $pay=new payment();
        $pay->claim_id=session()->get('claim');
        $pay->payment_id=$req->PaymentId;
        $pay->result=$req->Result;
        $pay->track_id=$req->TrackId;
        $pay->auth_code=$req->AuthCode;
        $pay->response_code=$req->ResponseCode;
        $pay->rrn=$req->RRN;
        $pay->amount=$req->amount;
        $pay->card_brand=$req->cardBrand;
        $pay->masked_pan=$req->maskedPAN;
        $pay->masked_pan=$req->maskedPAN;
        $pay->save();

        if($req->ResponseCode==000){
            $claim=Claim::where('id',session()->get('claim'))->first();
            $claim->pay_status=1;
            $claim->save();
            $response=DebtorResponse::where('claim_id',session()->get('claim'))->first();
            if($response==null){
               
                $res=new DebtorResponse();
                $res->claim_id=session()->get('claim');
                $res->response=3;
                $res->save();
            }else{
                $response->response=3;
                $response->save();
            }
          
    
            // $debivrres=DebIvrResponse::where('claim_id',session()->get('claim'))->first();
    
            // if ($debivrres != null || $debivrres != "")
            // {
            //     $debivrres->pay_status="payed";
            //     $debivrres->save();
            // }
    
            session()->forget('claim');
        //        session()->forget('url');
    
            return redirect(url(session()->get('url')));
    
        }else{
            return redirect(url(session()->get('url')));
        }
    }
        
    public function delayPaymentRespone(Request $req){


        $delaypay=PayDelay::where('pay_id',$req->PaymentId)->first();

        try{
            if($delaypay->status==2){
                
                    $pay=new payment();
                    $pay->claim_id=$delaypay->claim_id;
                    $pay->payment_id=$req->PaymentId;
                    $pay->result=$req->Result;
                    $pay->track_id=$req->TrackId;
                    $pay->auth_code=$req->AuthCode;
                    $pay->response_code=$req->ResponseCode;
                    $pay->rrn=$req->RRN;
                    $pay->amount=$req->amount;
                    $pay->card_brand=$req->cardBrand;
                    $pay->masked_pan=$req->maskedPAN;
                    $pay->masked_pan=$req->maskedPAN;
                    $pay->save();
        
                    if($req->ResponseCode==000){
                        $claim=Claim::where('id',$delaypay->claim_id)->first();
                        $claim->pay_status=1;
                        $claim->status=3;
                        $claim->save();
                        $delaypay->status=3;
                        $delaypay->save();
                        $pay=[$pay->payment_id, $pay->amount,$pay->card_brand,$pay->create_at];
                        return view('payment',compact('pay'));
                       
                    
                    }else{
                            $errorCode=$req->ResponseCode;
                            return view('pay_error',compact('errorCode'));
                         
                    }
            }else if( $delaypay->status==3){
                 $errorCode='Already Payment Done';
                 return view('pay_error',compact('errorCode'));
            }else{
                                 
                $errorCode=$req->ResponseCode;
                return view('pay_error',compact('errorCode'));
                     
            }
           
                
            
        }catch(\Exception $e){
            return 'Try Again';
        }
       

    }
      
    public function partialPaymentResponse(Request $req){

// dd($req->PaymentId);
        $partialPay=PartialPay::where('pay_id',$req->PaymentId)->first();

        try{
           
           if($partialPay->status==2){
                $errorcount=payment::where('response_code','!=','000')->where('payment_id',$req->PaymentId)->count();
           
                    
                            $pay=new payment();
                            $pay->claim_id=$partialPay->claim_id;
                            $pay->payment_id=$req->PaymentId;
                            $pay->result=$req->Result;
                            $pay->track_id=$req->TrackId;
                            $pay->auth_code=$req->AuthCode;
                            $pay->response_code=$req->ResponseCode;
                            $pay->rrn=$req->RRN;
                            $pay->amount=$req->amount;
                            $pay->card_brand=$req->cardBrand;
                            $pay->masked_pan=$req->maskedPAN;
                            $pay->masked_pan=$req->maskedPAN;
                            $pay->save();

                            if($req->ResponseCode==000){
                                $claim=Claim::where('id',$partialPay->claim_id)->first();
                                $claim->pay_status=1;
                                $claim->status=3;
                                $partialPay->status=3;
                                $partialPay->amount=$pay->amount;
                                $partialPay->save();
                                $claim->save();
                                $pay=[$pay->payment_id, $pay->amount,$pay->card_brand,$pay->create_at];
                                return view('payment',compact('pay'));
                            }else{
                                    $errorCode=$req->ResponseCode;
                                    return view('pay_error',compact('errorCode'));
                               
                            }
                    
            }else if($partialPay->status==3){
                        $errorCode='Already Payment Done';
                        return view('pay_error',compact('errorCode'));
            }else{
                $errorCode=$req->ResponseCode;
                return view('pay_error',compact('errorCode'));
            }
           
           
        }catch(\Exception $e){
            
            return 'Try Again';
            
        }
       

    }
    
    
    public function adminPayResponse(Request $req){

        $adminPay=PaymentLink::where('payment_id',$req->PaymentId)->first();

        try{
            
            if($adminPay->status==1){
                
                        $pay=new payment();
                        $pay->claim_id=$adminPay->claim_id;
                        $pay->payment_id=$req->PaymentId;
                        $pay->result=$req->Result;
                        $pay->track_id=$req->TrackId;
                        $pay->auth_code=$req->AuthCode;
                        $pay->response_code=$req->ResponseCode;
                        $pay->rrn=$req->RRN;
                        $pay->amount=$req->amount;
                        $pay->card_brand=$req->cardBrand;
                        $pay->masked_pan=$req->maskedPAN;
                        $pay->masked_pan=$req->maskedPAN;
                        $pay->save();
    
                        if($req->ResponseCode==000){
                            
                                $claim=Claim::where('id',$adminPay->claim_id)->first();
                                if($pay->amount==$claim->amount_after_discount){
                                    $claim->status=3;
                                    $claim->save();
                                }
                                
                                $adminPay->status=2;
                                $adminPay->save();
                                $pay=[$pay->payment_id, $pay->amount,$pay->card_brand,$pay->create_at];
                                return view('payment',compact('pay'));
                                
                        }else{
                            
                            $errorCode=$req->ResponseCode;
                            return view('pay_error',compact('errorCode'));
                        }
            
            }else if($adminPay->status==2){
                $errorCode='Already Payment Done';
                return view('pay_error',compact('errorCode'));
            }
            
            
        }catch(\Exception $e){
            return 'Try Again';
            
        }


    }
    
    
     public function sadadRes(Request $req){
       
        if($req->all() != null){
                    if($_GET['TranId']!=null && $_GET['amount']!=null && $_GET['ResponseCode']!=null){
            $merchantKey="74f5a88215a11c1fd76fa7540b26c1562565c7ab19ebaee21c09063057c327fe";
            $requestHash ="".$_GET['TranId']."|".$merchantKey."|".$_GET['ResponseCode']."|".$_GET['amount']."";
            $hash=hash('sha256', $requestHash);
    
            $transId =  $req->TranId;
            try{
               if($hash == $_GET['responseHash']){

               
                $response= new SadadResponse;
                $response->tranId=$req->TranId;
                $response->claimid=$req->UserField3;
                $response->trackId=$req->TrackId;
                $response->result=$req->Result;
                $response->responseCode=$req->ResponseCode;
                $response->responseHash=$req->responseHash;
                $response->sadadNumber=$req->sadadNumber;
                $response->billNumber=$req->billNumber;
                $response->amount=$req->amount;
                $response->status=1;
                $response->alldata=json_encode($req->all());
                $response->save();
                return "done";

            }else{
                
                    $response= new SadadResponse;
                    $response->tranId=$req->TranId;
                    $response->claimid=$req->UserField3;
                    $response->trackId=$req->TrackId;
                    $response->result=$req->Result;
                    $response->responseCode=$req->ResponseCode;
                    $response->responseHash=$req->responseHash;
                    $response->sadadNumber=$req->sadadNumber;
                    $response->billNumber=$req->billNumber;
                     $response->amount=$req->amount;
                    $response->status=0;
                     $response->alldata=json_encode($req->all());
                    $response->save();
                    return "done";
            }  
            }catch(\Exception $e){
                
                 $response= new SadadResponse;
                $response->tranId=0;
                $response->claimid=0;
                $response->trackId=0;
                $response->result=0;
                $response->responseCode=0;
                $response->responseHash=0;
                $response->sadadNumber=0;
                $response->billNumber=0;
                $response->amount=0;
                $response->alldata=json_encode($req->all());
                $response->status=2;
                $response->save();
              //  dd($e);
                return "Something went wrong. Contact with system Admin";
            }
           
            
        }
        }else{
           // return "Required Parameter not given";
                $response= new SadadResponse;
                $response->tranId=0;
                $response->claimid=0;
                $response->trackId=0;
                $response->result=0;
                $response->responseCode=0;
                $response->responseHash=0;
                $response->sadadNumber=0;
                $response->billNumber=0;
                $response->amount=0;
                $response->status=3;
                $response->alldata=json_encode($req->all());
                $response->save();
                 return "Required Parameter not given";
        }
        
        
       

    }



}
