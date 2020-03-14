<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function show(Order $order, Request $request)
    {
        return view('orders.show', ['order' => $order->load('category')]);
    }
}
