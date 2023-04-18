<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Report;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class EveryDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create report every day';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        $time = Carbon::yesterday()->toDateString();
        $orders = Order::where('is_closed','=',true)
            ->where('date_closed', '>=',$time)
            ->where('date_closed','<=',date(now()))->get();
        if ($orders){
            $count = $orders->count();
            $total_cost = $orders->sum('total_cost');
        }
        $report = Report::create([
                'total_cost'=>$total_cost,
                'total_orders'=>$count,
            ]
        );
        $report->save();
    }
}
