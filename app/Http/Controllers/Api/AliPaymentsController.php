<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidRequestException;
use App\Models\Order;
use Illuminate\Http\Request;
use Yansongda\Pay\Pay;

class AliPaymentsController extends Controller
{
    //网页支付
    public function aliPayWeb(Order $order, Request $request)
    {
        //订单已支付或已关闭
        if($order->date_pay || $order->del) {
            throw new InvalidRequestException('订单状态不正确!');
        }
        //调用支付宝的网页支付
        return app('alipay_pay_web')->web([
//            'out_trade_no' => $order->orderid,
//            'total_amount' => $order->price,
//            'subject' => '支付检测的订单' . $order->orderid,
            'out_trade_no' => time(),
            'total_amount' => '1',
            'subject' => 'test subject - 测试',
        ]);
    }

    //前端回调页面
    public function alipayReturn()
    {
        //校验提交的参数是否合法
        $data = Pay::alipay(config('pay.alipay'))->verify();
        dd($data);
    }

    //服务器端回调
    public function alipayNotify()
    {
        $data = Pay::alipay(config('pay.alipay'))->verify();
        \Log::debug('Alipay notify', $data->all());
    }
}
