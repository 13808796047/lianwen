<?php

namespace App\Http\Controllers;

use App\Handlers\FileUploadHandler;
use App\Handlers\FileWordsHandle;
use App\Handlers\OrderApiHandler;
use App\Handlers\WordHandler;
use App\Jobs\CheckOrderStatus;
use App\Models\Category;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
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
        dd($order);
    }

    public function download(Order $order)
    {
        return response()->download(storage_path() . '/app/' . $order->report_path);
    }
}
