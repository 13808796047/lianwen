<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderPaid;
use App\Exceptions\InvalidRequestException;
use App\Handlers\FileUploadHandler;
use App\Handlers\FileWordsHandle;
use App\Handlers\OrderApiHandler;
use App\Handlers\WordHandler;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Jobs\CheckOrderStatus;
use App\Mail\OrderReport;
use App\Models\Category;
use App\Models\Order;
use App\Services\OrderService;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use mysql_xdevapi\Exception;
use PhpOffice\PhpWord\IOFactory;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class OrdersController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    //提交订单
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
        return new OrderResource($order);
    }

    public function index(Request $request)
    {
        $orders = $request->user()->orders()->with('category:id,name')->latest()->get();;
        return OrderResource::collection($orders);
    }

    public function show(Request $request, Order $order)
    {
        //        校验权限
        return new OrderResource($order);
    }

    public function viewPdf(Order $order, OrderApiHandler $apiHandler)
    {
        $pdf = $apiHandler->extractReportPdf($order->api_orderid);
        return response(compact('pdf'))->setStatusCode(200);
    }

    public
    function destroy(Request $request)
    {
        if(!is_array($request->ids)) {
            $ids = [$request->ids];
        }
        $ids = $request->ids;
        Order::whereIn('id', $ids)->delete();
        return response()->json([
            'message' => '删除成功!'
        ]);
    }

    public
    function reportMail(Request $request, Order $order)
    {
        $to = $request->email_address;
        //发送
        try {
            Mail::to($to)->send(new OrderReport($order));
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
        return response()->json([
            'message' => '邮件发送成功,请注意查收！'
        ]);
    }
}
