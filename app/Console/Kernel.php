<?php

namespace App\Console;

use App\Models\Order;
use App\Models\Report;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command($this->makeReport(date('Y-m-d', strtotime(now(). " - 24 hours"))))->daily('8:00');
        $schedule->command($this->makeReport(date('Y-m-d', strtotime(now(). " - 5 day"))))->weekly(1,'12:00');
        $schedule->command($this->makeReport(date('Y-m-d', strtotime(now(). " - 30 day"))))->monthly();
        $schedule->command($this->makeReport(date('Y-m-d', strtotime(now(). " - 90 day"))))->quarterly();
        $schedule->command($this->makeReport(date('Y-m-d', strtotime(now(). " - 365 day"))))->yearly();
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    public function makeReport($time){
        $orders = Order::where('is_closed','=',true)
            ->where('date_closed', '>=',date($time))
            ->where('date_closed','<=',date(now()))->get();
        $total_cost = 0;
        $total_orders = 0;
        foreach ($orders as $order)
        {
            $total_cost += $order['total_cost'];
            $total_orders += 1;
        }
        Report::create([
                'total_cost'=>$total_cost,
                'total_orders'=>$total_orders,
                'create_date'=>now()
            ]
        );



      //      ->where('date_closed', '>=',date("2022-5-12 12:21:22"))
         //   ->where('date_closed','<=',date(now()))->get();
    }
}
