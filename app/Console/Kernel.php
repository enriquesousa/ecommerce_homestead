<?php

namespace App\Console;

use App\Models\Order;
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
    protected function schedule(Schedule $schedule){
        // $schedule->command('inspire')->hourly();

        $schedule->call(function(){

            // que hora era hace 10 minutos, usar carbon
            $hora = now()->subMinutes(10);
            // echo $hora->toDateTimeString();
            // $current_date_time=Carbon::now();

            $orders = Order::where('status', 1)->whereTime('created_at', '<=', $hora)->get();

            foreach ($orders as $order) {
                $items = json_decode($order->content);
                foreach ($items as $item) {
                    increase($item); // llamar al helper
                }
                $order->status = 5; // anulado
                $order->save();
            }

        })->everyMinute();

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
