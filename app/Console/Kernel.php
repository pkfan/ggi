<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         //$schedule->command('ivr_call:scheduler')->everyMinute();
          $schedule->command('remainder:mail')->timezone('Asia/Riyadh')->everyMinute();
          $schedule->command('distribute:claim')->dailyAt('17:00');
          $schedule->command('payment:delay')->everyMinute();
          $schedule->command('partial:payment')->everyMinute();
          $schedule->command('call:status')->everyFiveMinutes();
          $schedule->command('elm:status')->everyFiveMinutes();
          $schedule->command('claim:collected')->everyTenMinutes();
          //$schedule->command('ivr_call:scheduler')->everyMinute();
        //   added by Muhammad Amir
          $schedule->command('call:MonitorOfficerTargetsStatus')->everyTenMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
