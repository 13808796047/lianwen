<?php

namespace App\Http\Controllers;

use App\Handlers\OrderApiHandler;
use App\Jobs\CheckOrderStatus;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
//    public function show(Order $order, Request $request)
//    {
//
////        return \Storage::disk('local')->download('downloads/report-1.zip');
////        $file = $apiHandler->downloadReport($order->api_orderid);
////        $path = 'downloads\report-' . $order->id . '.zip';
////        $result = \Storage::put($path, $file);
////        dd($result);
////        return view('orders.show', ['order' => $order->load('category')]);
//    }
    public function download(Order $order)
    {
//        $this->dispatch(new CheckOrderStatus($order));
//        //        校验权限
//        $this->authorize('own', $order);
        return response()->download(storage_path('app/downloads/') . $order->report_path);
    }
}
