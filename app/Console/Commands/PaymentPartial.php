<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Claim;
use App\Models\PartialPay;
use App\Models\DelayError;
use App\Models\ClaimStatus;
use Carbon\Carbon;
use Mail;


class PaymentPartial extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'partial:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'status partial payment';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $current_date=Carbon::now()->format('Y-m-d H:i');
        $count=PartialPay::where('date_time',$current_date.":00")->where('status',1)->count();
        $pay=PartialPay::where('date_time',$current_date.":00")->where('status',1)->get();

        if($count!=0){
            foreach($pay as $delay){
                
                $claimStatus=ClaimStatus::where('claim_id',$delay->claim_id)->first();
                
                if($claimStatus->status==4){
                        $claimid=$delay->claim_id;
                        $claim=Claim::where('id',$claimid)->first();
                        $installment=PartialPay::where('claim_id',$claimid)->count();
                        if($delay->amount == null){
                            $amount1=$claim->amount_after_discount/$installment;
                         
                            $amount=round($amount1);
                        }else{
                             $amount=$delay->amount;
                        }
                        
                                $link=createPaymentLinkAmt($claimid,$amount);
                                if($link!=1){
                                    try{
                                       
                                        
                                       // $message='عزيزي العميل نرجو التكرم بسداد المبلغ '.$amount.' الرجاء الضغط على الرابط التالي ليتم السداد من خلال احدى قنوات الدفع الرسمية المعتمدة لديكم '.$link[0].' ، تذكر دائماً أن الخليجية العامة لن تطلب أي أرقام سرية خاصة بكم بأي حال من الأحوال';
                                        $message='عزيزي العميل '.$claim->deb_name.'نرجو التكرم بسداد المبلغ '.$amount.' الرجاء الضغط على الرابط التالي ليتم السداد من خلال احدى قنوات الدفع الرسمية المعتمدة لديكم '.$link[0].' ، تذكر دائماً أن الخليجية العامة لن تطلب أي أرقام سرية خاصة بكم بأي حال من الأحوال';

                                        $reciever=$claim->deb_mob;
                                        adminSendMessage($reciever,$message, $claimid);
                                        $delay->link=$link[0];
                                        $delay->pay_id=$link[1];
                                        $delay->amount=$amount;
                                        $delay->status=2;
                                        $delay->save();
                                    
                                        }catch(\Exception $e){
                                            
                                            $delay_error=new DelayError;
                                            $delay_error->claim_id=$claimid;
                                            $delay_error->error="SMS not send";
                                            $delay_error->save();
                
                                        }
                                }else{
                                                $delay_error=new DelayError;
                                                $delay_error->claim_id=$claimid;
                                                $delay_error->error="payment link error";
                                                $delay_error->save();
                                }
                        
                        
                       
                        
                        
                }
                
               
                
                
                
            }
        
          

        }



        return 0;
    }
}
