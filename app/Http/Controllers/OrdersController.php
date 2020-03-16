<?php

namespace App\Http\Controllers;

use App\Handlers\OrderApiHandler;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function show(Order $order, Request $request, OrderApiHandler $apiHandler)
    {
//        $result = $apiHandler->fileUpload($order);
//        $apiOrder = $apiHandler->createOrder($order, $result);
//        $apiHandler->startCheck($apiOrder);
//        dd($apiHandler->getOrder($apiOrder));
        return view('orders.show', ['order' => $order->load('category')]);
    }


}
