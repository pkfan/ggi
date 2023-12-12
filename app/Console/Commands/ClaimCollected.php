<?php

namespace App\Console\Commands;
use App\Models\PartialPay;
use App\Models\ClaimStatus;
use App\Models\Claim;
use App\Models\PartialManual;
use App\Models\payment;
use App\Models\SadadResponse;
use App\Models\CollectedClaim;
use Illuminate\Console\Command;

class ClaimCollected extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'claim:collected';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'mark claim as collected ';

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

        $claimstatuses = ClaimStatus::where('status',4)->get();
           // dd($claimstatuses[0]);
       
        for($i=0 ; $i<$claimstatuses->count() ; $i++){

            $claim = Claim::where('id',$claimstatuses[$i]->claim_id)->first();
            $amount = $claim->amount_after_discount;

            $payment =       payment::where('claim_id',$claim->id)->where('response_code',000)->sum('amount');
            $sadad =         SadadResponse::where('claimid',$claim->id)->where('Result','Success')->sum('amount');
            $partialmanual = PartialManual::where('claim_id',$claim->id)->sum('amount');
            $collectedvia = ' ';
            $total = $payment + $sadad + $partialmanual;
            if($sadad >= $amount){
                $collectedvia ="Sadad";
            }else if($payment  >=  $amount){
                $collectedvia = "Mada";
            }else if($partialmanual >= $amount){
                $collectedvia = "Manual";
            }else if( $sadad + $payment >= $amount){
                $collectedvia ="sadad & madad";
            }else if( $payment + $sadad + $partialmanual >= $amount ){
                $collectedvia ="All method";
            }else{
                $collectedvia =" ";
            }
           // dd($total, $amount);
            if($amount <=  $total){
                $claimstatuses[$i]->status=2;
                $claimstatuses[$i]->save();
                $collectedclaim = new CollectedClaim();
                $collectedclaim->claim_id = $claim->id;
                $collectedclaim->payment = $collectedvia;
                $collectedclaim->update_by = 0;
                $collectedclaim->save();
            }
            
           

        }
        
        $delayclaim = ClaimStatus::where('status',3)->get();
        for($i=0 ; $i<$delayclaim->count() ; $i++){

            $claim = Claim::where('id',$delayclaim[$i]->claim_id)->first();
            $amount = $claim->amount_after_discount;

            $payment =       payment::where('claim_id',$claim->id)->where('response_code',000)->sum('amount');
            $sadad =         SadadResponse::where('claimid',$claim->id)->where('Result','Success')->sum('amount');
            $partialmanual = PartialManual::where('claim_id',$claim->id)->sum('amount');
            $collectedvia = ' ';
            $total = $payment + $sadad + $partialmanual;
            if($sadad >=  $amount){
                $collectedvia ="Sadad";
            }else if($payment  >=   $amount){
                $collectedvia = "Mada";
            }else if($partialmanual >=  $amount){
                $collectedvia = "Manual";
            }else if( $sadad + $payment >=  $amount){
                $collectedvia ="sadad & madad";
            }else if( $payment + $sadad + $partialmanual >=  $amount ){
                $collectedvia ="All method";
            }else{
                $collectedvia =" ";
            }
           // dd($total, $amount);
            if($amount <=  $total){
                $delayclaim[$i]->status=2;
                $delayclaim[$i]->save();
                $collectedclaim = new CollectedClaim();
                $collectedclaim->claim_id = $claim->id;
                $collectedclaim->payment = $collectedvia;
                $collectedclaim->update_by = 01;
                $collectedclaim->save();
            }
            
           

        }
       

        return 0;
    }
}
