<?php

namespace App\Console;

use Carbon\Carbon;
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
        // $schedule->command('inspire')
        // ->everyMinute()
        // ->withoutOverlapping()
        // ->sendOutputTo(storage_path('logs/inspire' . time() . ".log"));

        $schedule->command('queue:work --stop-when-empty --tries=3')
        ->everyMinute()
        ->withoutOverlapping()
        ->sendOutputTo(storage_path('logs/workers.log'));

        // $schedule->command('system:deactive-expired-subscription')
        // ->timezone('Asia/Manila')
        // ->dailyAt('9:00')
        // ->withoutOverlapping()
        // ->sendOutputTo(storage_path('logs/deactive-subs.log'));

        // $schedule->command('system:notify-near-expiration-subscription')
        // ->timezone('Asia/Manila')
        // ->dailyAt('9:00')
        // ->withoutOverlapping()
        // ->sendOutputTo(storage_path('logs/notify-near-subs.log'));

        // // Run every last day of the month midnight
        // $schedule->command('system:reset-active-subscriptions')
        // ->timezone('Asia/Manila')
        // ->monthlyOn(1)
        // ->withoutOverlapping()
        // ->sendOutputTo(storage_path('logs/reset-counters.log'));
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
