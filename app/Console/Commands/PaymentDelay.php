<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Claim;
use App\Models\PayDelay;
use App\Models\ClaimStatus;
use App\Models\DelayError;
use Carbon\Carbon;
use Mail;
class PaymentDelay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:delay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Payment Deley message and email';

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
        $count=PayDelay::where('date_time',$current_date.":00")->where('status',1)->count();
      
        $pay=PayDelay::where('date_time',$current_date.":00")->where('status',1)->get();
    // dd( $current_date);
        if($count>0){
          
            foreach($pay as $delay){
                $claimStatus=ClaimStatus::where('claim_id',$delay->claim_id)->first();
                
                if($claimStatus->status==3){
                        
                        $claimid=$delay->claim_id;
                        $claim=Claim::where('id',$claimid)->first();
                        
                        
                             $link=delayPamentLinks($claimid);
                        if($link!=1){
                                    //dd($link);
                            try{
                               // $message='عزيزي العميل نرجو التكرم بسداد المبلغ '.$claim->amount_after_discount.' الرجاء الضغط على الرابط التالي ليتم السداد من خلال احدى قنوات الدفع الرسمية المعتمدة لديكم '.$link[0].' ،تذكر دائماً أن الخليجية العامة لن تطلب أي أرقام سرية خاصة بكم بأي حال من الأحوال';
                               $message='عزيزي العميل '.$claim->deb_name.'نرجو التكرم بسداد المبلغ '.$claim->amount_after_discount.' الرجاء الضغط على الرابط التالي ليتم السداد من خلال احدى قنوات الدفع الرسمية المعتمدة لديكم '.$link[0].' ،تذكر دائماً أن الخليجية العامة لن تطلب أي أرقام سرية خاصة بكم بأي حال من الأحوال';

                                $reciever=$claim->deb_mob;
                                adminSendMessage($reciever,$message, $claimid);
                                $delay->link=$link[0];
                                $delay->pay_id=$link[1];
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
       


    }
}
