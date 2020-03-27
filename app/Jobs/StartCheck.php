<?php

namespace App\Jobs;

use App\Handlers\OrderApiHandler;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StartCheck implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }


    public function handle()
    {
        $api = app(OrderApiHandler::class);
        $result = $api->startCheck($this->order->api_orderid);
        info('开始检测....');
        if($result->code == 200) {
            dispatch(new getOrderStatus($this->order))->delay(now()->addMinutes());
        }
    }
}
