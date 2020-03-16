<?php

namespace App\Http\Controllers;

use App\Handlers\OrderApiHandler;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {

    }

    public function show(Order $order, Request $request, OrderApiHandler $apiHandler)
    {
        return view('orders.show', ['order' => $order->load('category')]);
    }
}
