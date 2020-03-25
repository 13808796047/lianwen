<?php

namespace App\Models\Traits;

use App\Handlers\OrderApiHandler;
use App\Jobs\CheckOrderStatus;
use App\Models\Enum\OrderEnum;
use App\Models\Order;

trait CheckOrderHelper
{
    public function getOrderStatus()
    {
        $orders = Order::query()->where('status', 3)->get();
        foreach($orders as $order) {
            new CheckOrderStatus($order);
        }
    }
}
