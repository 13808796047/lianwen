<?php

namespace App\Models\Traits;

use App\Handlers\OrderApiHandler;
use App\Jobs\CheckOrderStatus;
use App\Models\Enum\OrderEnum;
use App\Models\Order;
use Illuminate\Support\Facades\Log;


trait CheckOrderHelper
{
    public function getOrderStatus()
    {
        $orders = Order::query()->where('status', 3)->orWhere('status', 5)->get();
        foreach($orders as $order) {
            dispatch(new CheckOrderStatus($order));
            Log::info($order->id . '检测完成');
        }
    }
}
