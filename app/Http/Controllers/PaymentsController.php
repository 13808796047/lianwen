<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestException;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function alipay(Order $order, Request $request)
    {
        if($order->pay_date || $order->del) {
            throw new InvalidRequestException('订单状态不正确!');
        }
        // 调用支付宝的网页支付
        return app('alipay')->web([
            'out_trade_no' => $order->orderid, // 订单编号，需保证在商户端不重复
            'total_amount' => $order->price, // 订单金额，单位元，支持小数点后两位
            'subject' => '支付 联文检测 的订单：' . $order->orderid, // 订单标题
        ]);
    }

    // 前端回调页面
    public function alipayReturn()
    {
        try {
            app('alipay')->verify();
        } catch (\Exception $e) {
            return view('pages.error', ['msg' => '数据不正确']);
        }

        return view('pages.success', ['msg' => '付款成功']);
    }

    // 服务器端回调
    public function alipayNotify()
    {
        // 校验输入参数
        $data = app('alipay')->verify();
        // 如果订单状态不是成功或者结束，则不走后续的逻辑
        // 所有交易状态：https://docs.open.alipay.com/59/103672
        if(!in_array($data->trade_status, ['TRADE_SUCCESS', 'TRADE_FINISHED'])) {
            return app('alipay')->success();
        }
        // $data->out_trade_no 拿到订单流水号，并在数据库中查询
        $order = Order::where('orderid', $data->out_trade_no)->first();

        // 正常来说不太可能出现支付了一笔不存在的订单，这个判断只是加强系统健壮性。
        if(!$order) {
            return 'fail';
        }
        // 如果这笔订单的状态已经是已支付
        if($order->date_pay) {
            // 返回数据给支付宝
            return app('alipay')->success();
        }

        $order->update([
            'date_pay' => Carbon::now(), // 支付时间
            'pay_type' => 'alipay', // 支付方式
            'payid' => $data->trade_no, // 支付宝订单号
            'pay_price' => $data->total_amount,//支付金额
            'status' => 1,
        ]);

        return app('alipay')->success();
    }
}
