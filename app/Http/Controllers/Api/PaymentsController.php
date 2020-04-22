<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderPaid;
use App\Exceptions\InvalidRequestException;
use App\Handlers\NuomiRsaSign;
use App\Handlers\OpenidHandler;
use App\Models\Order;
use Carbon\Carbon;
use Endroid\QrCode\QrCode;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Yansongda\Pay\Pay;

class PaymentsController extends Controller
{
    //
    public function wechatPayMp(Order $order, Request $request, OpenidHandler $openidHandler)
    {
        // 校验权限
        // 校验订单状态
        if($order->status == 1 || $order->del) {
            throw new InvalidRequestException('订单状态不正确');
        }
        $openid = $request->user()->openid;
        return app('wechat_pay_wap')->mp([
            'out_trade_no' => $order->orderid,  // 商户订单流水号，与支付宝 out_trade_no 一样
            'total_fee' => $order->price * 100, // 与支付宝不同，微信支付的金额单位是分。
            'body' => '支付' . $order->category->name . ' 的订单：' . $order->orderid, // 订单描述
            'openid' => $openid
        ]);
    }

    //百度支付
    public function mockData(Order $order, Request $request)
    {
        if($order->status == 1 || $order->del) {
            throw new InvalidRequestException('订单状态不正确');
        }
        $domain = request()->getHost();
        switch ($domain) {
            case 'dev.lianwen.com':
                $data['dealId'] = config('pay.dev_baidu_pay.dealId');
                $data['appKey'] = config('pay.dev_baidu_pay.appKey');
                break;
            default:
                $data['dealId'] = config('pay.zcnki_baidu_pay.dealId');
                $data['appKey'] = config('pay.zcnki_baidu_pay.appKey');
                break;
        }

        $data['totalAmount'] = $order->price * 100;
        $data['tpOrderId'] = $order->orderid;
        $data['rsaSign'] = app('baidu_pay')->getSign($data);
        $data['dealTitle'] = '支付 ' . $order->category->name . ' 的订单' . $order->orderid; // 订单的名称
        $data['signFieldsRange'] = 1; // 固定值1
        $data['bizInfo'] = ''; // 其他信息
        return response()->json($data)->setStatusCode(200);
    }
}
