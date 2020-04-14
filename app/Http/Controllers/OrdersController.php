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

    public function store(OrderRequest $request, FileUploadHandler $uploader, FileWordsHandle $fileWords, WordHandler $wordHandler)
    {
        $user = $request->user();

        $category = Category::findOrFail($request->cid);
//        if($category->status == 0) {
//            return response()->json([
//                'message' => '此检测通道已关闭!'
//            ], 401);
//        }
        $order = $this->orderService->add($user, $category, $uploader, $request, $fileWords, $wordHandler);
        return redirect()->route('orders.show', compact('order'));
    }

    public function show(Order $order)
    {
        return view('domained::orders.show', compact('order'));
    }

    public function viewReport(Order $order)
    {
        return view('domained::orders.view_report', compact('order'));
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
        $order = Order::where('orderid', $orderid)->first();
        return response()->download(storage_path() . '/app/' . $order->report_path);
    }
}
