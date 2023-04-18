<?php

namespace App\Console;

use App\Models\Order;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        //$schedule->command($this->makeReport())->daily('8:00');
        $schedule->command('report:create')->daily('8:00')->runInBackground();
        $schedule->command('auth:clear-resets')->everyThreeHours();
    }
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

}
