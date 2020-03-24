<?php

namespace App\Http\Controllers;

use App\Handlers\FileUploadHandler;
use App\Handlers\FileWordsHandle;
use App\Handlers\OrderApiHandler;
use App\Handlers\WordHandler;
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
        $orders = $request->user()->orders()->with('category:cid,name')->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request, FileUploadHandler $uploader, FileWordsHandle $fileWords, WordHandler $wordHandler)
    {
        $user = $request->user();

        $category = Category::where('cid', $request->cid)->first();
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
        return view('orders.show', compact('order'));
    }

    public function viewReport(Order $order)
    {
        return view('orders.view_report', compact('order'));
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

    public function download(Order $order)
    {
        return response()->download(storage_path() . '/app/' . $order->report_path);
    }
}
