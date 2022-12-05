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
        // $schedule->command('inspire')->hourly();
        $schedule->command('queue:work --stop-when-empty --tries=3')
        ->everyMinute()
        ->withoutOverlapping();

        $schedule->command('system:deactive-expired-subscription')
        ->timezone('Asia/Manila')
        ->dailyAt('09:00')
        ->withoutOverlapping();

        $schedule->command('system:notify-near-expiration-subscription')
        ->timezone('Asia/Manila')
        ->dailyAt('09:00')
        ->withoutOverlapping();
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
