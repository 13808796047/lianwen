<?php

namespace App\Http\Controllers;

use App\Events\OrderPaid;
use App\Handlers\DocxConversionHandler;
use App\Handlers\FileUploadHandler;
use App\Handlers\FileWordsHandle;
use App\Handlers\OrderApiHandler;
use App\Handlers\WordHandler;
use App\Http\Requests\Api\OrderRequest;
use App\Jobs\CheckOrderStatus;
use App\Jobs\OrderCheckedMsg;
use App\Jobs\OrderPendingMsg;
use App\Mail\OrderReport;
use App\Models\Category;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $orders = $request->user()->orders()->with('category:id,name')->latest()->paginate(10);
        return view('domained::orders.index', compact('orders'));
    }

    public function store(OrderRequest $request)
    {
        $order = $this->orderService->add($request);
        if($order->status == 0 && $order->user->weixin_openid) {
            dispatch(new OrderPendingMsg($order))->delay(now()->addMinutes(2));
        }
        return redirect()->route('orders.show', compact('order'));
    }

    public function show(Order $order)
    {
//        $this->dispatch(new CheckOrderStatus($order));
//        校验权限
        $this->authorize('own', $order);
        return view('domained::orders.show', compact('order'));
    }

    public function viewReport(Order $order, OrderApiHandler $apiHandler)
    {
        //校验权限
        $this->authorize('own', $order);
        $pdf = $apiHandler->extractReportPdf($order->api_orderid);
        return view('domained::orders.view_report', compact('order', 'pdf'));
    }

    public function destroy(Request $request)
    {
        if(!is_array($request->ids)) {
            $ids = [$request->ids];
        }
        $ids = $request->ids;
        Order::whereIn('id', $ids)->delete();
        return [];
    }

    public function download($orderid)
    {
        if(strlen($orderid) == 3) {
            $order = Order::findOrFail($orderid);
        } else {

            $order = Order::where('orderid', $orderid)->first();
        }
        //校验权限
        return response()->download(storage_path() . '/app/' . $order->report_path);
    }

}
