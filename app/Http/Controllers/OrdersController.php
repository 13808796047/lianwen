<?php

namespace App\Http\Controllers;

use App\Handlers\OrderApiHandler;
use App\Jobs\CheckOrderStatus;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function download(Order $order)
    {
        return response()->download(storage_path() . '/app/' . $order->report_path);
    }
}
