<?php

namespace App\Http\Controllers;

use App\Handlers\OrderApiHandler;
use App\Jobs\CheckOrderStatus;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {

    }

    public function show(Order $order, Request $request, OrderApiHandler $apiHandler)
    {
        $this->dispatch(new CheckOrderStatus($order));
        
        return view('orders.show', ['order' => $order->load('category')]);
    }
}
