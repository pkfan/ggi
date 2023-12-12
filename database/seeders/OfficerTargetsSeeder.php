<?php

// php artisan db:seed --class=OfficerTargetsSeeder

namespace Database\Seeders;

use App\Models\User;
use App\Models\Reason;
use Faker\Provider\Company;
use App\Models\OfficerTarget;
use Illuminate\Database\Seeder;

class OfficerTargetsSeeder extends Seeder
{

    private function setOfficerTarget($officer, $startDate, $endDate){
        $total = random_int(10000, 300000);
        $acheived = $total/random_int(1,10);
        $pending = $total - $acheived;
        $acheived_percentage = ($acheived/$total)*100;

        OfficerTarget::create([
            'officer_id'=>$officer->id,
            'total'=> random_int(10000, 300000),
            'achieved'=>$acheived,
            'pending'=>$pending,
            'acheived_percentage'=>$acheived_percentage,
            'start_date' => $startDate,
            'end_date' =>$endDate

        ]);
    }
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $officers = User::whereHasRole('officer')->get();

        foreach($officers as $officer){
            //////// 1 ///////////
            $day = random_int(10, 30);
            $month = random_int(2, 8);
            $nextMonth = $month + 1;

            $startDate = "2023-0{$month}-{$day}";
            $endDate = "2023-0{$nextMonth}-{$day}";

            $this->setOfficerTarget($officer, $startDate, $endDate);

            //////// 2 ///////////
            $day = random_int(10, 30);
            $month = random_int(2, 8);
            $nextMonth = $month + 1;

            $startDate = "2023-0{$month}-{$day}";
            $endDate = "2023-0{$nextMonth}-{$day}";

            $this->setOfficerTarget($officer, $startDate, $endDate);

            //////// 3 ///////////
            $day = random_int(10, 30);
            $month = random_int(2, 8);
            $nextMonth = $month + 1;

            $startDate = "2023-0{$month}-{$day}";
            $endDate = "2023-0{$nextMonth}-{$day}";

            $this->setOfficerTarget($officer, $startDate, $endDate);
        }
    }
}
