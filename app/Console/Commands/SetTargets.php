<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Claim;
use App\Models\payment;
use App\Models\PartialPay;
use App\Models\ClaimStatus;
use App\Models\OfficerTarget;
use App\Models\PartialManual;
use App\Models\SadadResponse;
use App\Models\CollectedClaim;
use Illuminate\Console\Command;

class SetTargets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'officerTargets:set';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'calculate all targets every 10 minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function officerTarget($officer_id)
    {
        $officerTarget = OfficerTarget::firstWhere('officer_id', $officer_id);

        if (!$officerTarget) {
            return 'officer target not found and set';
        }

        $claims = Claim::where('is_assign', $officer_id)->get();
        // dd($claims);
        // $totalAmount = 0;
        $recoverAmount = 0;

        foreach ($claims as $claim) {

            // $totalAmount += $claim->amount_after_discount;SS

            $payment = Payment::where('claim_id', $claim->id)
                ->where('response_code', 000)
                ->sum('amount');

            $recoverAmount += $payment;

            $sadadPayment = SadadResponse::where('claimid', $claim->id)
                ->where('responseCode', 000)
                ->sum('amount');

            $recoverAmount += $sadadPayment;

            $partialManual = PartialManual::where('claim_id', $claim->id)
                ->sum('amount');

            $recoverAmount += $partialManual;
        }

        // $officerTargets = OfficerTarget::firstWhere('officer_id', auth()->user()->id);


        // $total = $officerTargets->total;
        // $acheivedPercentage = ($recoverAmount / $totalAmount)*100;
        // $pendingTargets = $totalAmount - $recoverAmount;

        // return [
        //     'totalAmount'=>$totalAmount,
        //     'recoverAmount' => number_format($recoverAmount, 2),
        //     'pendingTargets' => $pendingTargets,
        //     'acheived_percentage' => number_format($acheivedPercentage, 2),
        // ];


        $acheivedPercentage = ($recoverAmount / $officerTarget->total) * 100;
        $pendingTargets = $officerTarget->total - $recoverAmount;

        OfficerTarget::where('officer_id', $officer_id)->update([
            'achieved' => $recoverAmount,
            'pending' => $pendingTargets,
            'acheived_percentage' => $acheivedPercentage,
        ]);

        return 'officer targets updated to latest data';
    }

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {
        // claim_collected
        // ----------------
        // payment
        // sadad_response
        // partial_manual

        $officers = User::whereHasRole('officer')->get();

        foreach ($officers as $officer) {
            $this->officerTarget($officer->id);
        }


        return 0;
    }
}
