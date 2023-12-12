<?php

namespace App\Console\Commands;

use App\Models\Claim;
use App\Models\DebIvrResponse;
use App\Models\DebtorResponse;
use Illuminate\Console\Command;

class IVR_Call_Scheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ivr_call:scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command initiate call against claim users after a day';

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
        $claims=Claim::where('status',1)->get();

//        echo "\n";
//        echo count($claims);
//        echo "\n";
//        echo $claims;
//        echo "\n";


//        echo "Fetch Data";
//        echo "\n";

        foreach ($claims as $claim)
        {

            if ($claim->pay_status == "1")
            {
//                echo "In pay status where pay == 1\n";

            }
            else
            {
                echo "In pay status where pay == null or empty 0\n";
                if ($claim->call_count >= 3)
                {
//                    echo "Call count greater than 3";
//                    echo "\n";

                    $uC=Claim::where('id',$claim->id)->first();
                    $uC->ivr_status=6;
                    $uC->save();
                }
                else
                {
//                    echo "Call count less than 3";
//                    echo "\n";

                    if ($claim->ivr_status == 1 || $claim->ivr_status == 2 || $claim->ivr_status == 3 || $claim->ivr_status == 4 || $claim->ivr_status == null || $claim->ivr_status == "")
                    {
//                        echo "About to sending call";
                        initiateCall($claim->deb_mob);

                        $updClm=Claim::where('id',$claim->id)->first();
                        $updClm->call_count+=1;
                        $updClm->save();
                    }
                    else
                    {

                    }
                }
            }
        }

        sendMailToFinancialCompanyForLoanPending();

        return "Job Done";
    }
}
