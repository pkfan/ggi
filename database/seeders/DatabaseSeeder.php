<?php

namespace Database\Seeders;

use App\Models\Reason;
use App\Models\User;
use Faker\Provider\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        $user=new User();
        $user->name="Admin";
        $user->email="admin@gmail.com";
        $user->password=bcrypt('12345678');
        $user->type="Admin";
        $user->roll=0;
        $user->save();



        // Company
        $comp=new User();
        $comp->name="company";
        $comp->email="company1@gmail.com";
        $comp->password=bcrypt('123456');
        $comp->cr_code="3454354353";
        $comp->type="Insurance Company";
        $comp->roll=1;
        $comp->status=0;
        $comp->save();

        // Company
        $comp1=new User();
        $comp1->name="company";
        $comp1->email="company2@gmail.com";
        $comp1->password=bcrypt('123456');
        $comp1->cr_code="3454354353";
        $comp1->type="Insurance Company";
        $comp1->roll=1;
        $comp1->status=0;
        $comp1->save();

        // Reason
        $reason1=new Reason();
        $reason1->description="Reason 1";
        $reason1->save();

        $reason2=new Reason();
        $reason2->description="Reason 2";
        $reason2->save();

        $reason3=new Reason();
        $reason3->description="Reason 3";
        $reason3->save();

    }
}
