<?php

/******* REQUIREMENTS CREATED BY MUHAMMAD AMIR*********
    if there is no active record make current date active record

    every 10 minute check active officer target dates are in current date.

    if date is not in current date, then make active record status (completed, or expired)

    100% achieved target within date range consider as completed.
    not 100% achieved target within date range consider as expired
 */

namespace App\Console\Commands;

use Carbon\Carbon;
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
use App\Enums\OfficerTargetStatus;

class MonitorOfficerTargetsStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'call:MonitorOfficerTargetsStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'change officer targets status based on (startdate, enddate) and achieved.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function officerTarget($officer)
    {
        /******* REQUIREMENTS CREATED BY MUHAMMAD AMIR*********
            if officer do not has any target then return null

            if there is no active target make current date range active target

            every 10 minute check active officer target dates are in current date.

            if date is not in current date, then make active record status (completed, or expired)

            100% achieved target within date range consider as completed.
            not 100% achieved target within date range consider as expired
         */


        $year = now()->year;
        $month = now()->month;
        $day = now()->day;

        $currentDate = "{$year}-{$month}-{$day}";
        $currentDateCarbon = Carbon::createFromFormat('Y-m-d', $currentDate);

        //  if officer do not has any target then return null
        $isOfficerTargetExist = OfficerTarget::firstWhere('officer_id', $officer->id);

        if(! $isOfficerTargetExist){
            return 'officer targets not set by supervisor.';
        }

        //  if there is no active target, make current date range active target
        $officerActiveTarget = OfficerTarget::where('officer_id', $officer->id)
            ->where('status', OfficerTargetStatus::ACTIVE->value)
            ->first();

        if (!$officerActiveTarget) {
            $isCurrentTargetExistForActive = OfficerTarget::where('officer_id', $officer->id)
                ->where('start_date', '<=', $currentDate)
                ->where('end_date', '>=', $currentDate)
                ->update([
                    'status' => OfficerTargetStatus::ACTIVE->value
                ]);

                if(! $isCurrentTargetExistForActive){
                    return 'there is not upcomming target to make active.';
                }
                // assign updated active target
                $officerActiveTarget = OfficerTarget::where('officer_id', $officer->id)
                    ->where('status', OfficerTargetStatus::ACTIVE->value)
                    ->first();

        }

        // every 10 minute check active officer target dates are in current date.
        $startDateActiveTargetCarbon = Carbon::createFromFormat('Y-m-d', $officerActiveTarget->start_date);
        $endDateActiveTargetCarbon = Carbon::createFromFormat('Y-m-d', $officerActiveTarget->end_date);

        if($currentDateCarbon->gte($startDateActiveTargetCarbon)
            &&
            $currentDateCarbon->lte($endDateActiveTargetCarbon)
        ){
            return 'officer active targets in progress within current date range';
        }

        // if date is not in current date,
        // then make active record status (completed, or expired)

        // 100% achieved target within date range consider as completed.
        // not 100% achieved target within date range consider as expired

        if($officerActiveTarget->achieved
            && $officerActiveTarget->achieved >= $officerActiveTarget->total
        ){
            OfficerTarget::where('officer_id', $officer->id)
                ->where('status', OfficerTargetStatus::ACTIVE->value)
                ->update([
                    'status'=>OfficerTargetStatus::COMPLETED->value
                ]);
        }
        else {
            OfficerTarget::where('officer_id', $officer->id)
                ->where('status', OfficerTargetStatus::ACTIVE->value)
                ->update([
                    'status'=>OfficerTargetStatus::EXPIRED->value
                ]);
        }

        // old active target status is completed or expired,
        // so make upcomming officer target as active status
        OfficerTarget::where('officer_id', $officer->id)
                ->where('start_date', '<=', $currentDate)
                ->where('end_date', '>=', $currentDate)
                ->update([
                    'status' => OfficerTargetStatus::ACTIVE->value
                ]);

        return 'officer targets status updated to latest one';
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
            $this->officerTarget($officer);
        }


        return 0;
    }
}
