<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderPaid;
use App\Exceptions\InvalidRequestException;
use App\Models\Order;
use Carbon\Carbon;
use Endroid\QrCode\QrCode;
use http\Env\Response;
use Illuminate\Http\Request;
use Yansongda\Pay\Pay;

class PaymentsController extends Controller
{
    public function alipayScan(Order $order)
    {
//        if($order->status == 1 || $order->del) {
//            throw new InvalidRequestException('订单状态不正确!');
//        }
        // 调用支付宝的网页支付
        $data = app('alipay')->web([
            'out_trade_no' => time(), // 订单编号，需保证在商户端不重复
            'total_amount' => 0.01, // 订单金额，单位元，支持小数点后两位
            'subject' => '支付 联文检测 的订单：' . time(), // 订单标题
        ]);
        return \response()->json($data);
    }

    // 前端回调页面
    public function alipayReturn()
    {
        try {
            app('alipay')->verify();
        } catch (\Exception $e) {
            return response()->json([
                'message' => '数据不正确'
            ]);
        }

        return response()->json([
            'message' => '付款成功!'
        ]);
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
        if($order->status == 1) {
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
        $this->afterPaid($order);
        return app('alipay')->success();
    }
    /******************************************************************微信***************************************************/
    //微信支付
    public function wechatScan(Order $order, Request $request)
    {
        // 校验权限
//        $this->authorize('own', $order);
        // 校验订单状态
//        if($order->status == 1 || $order->del) {
//            throw new InvalidRequestException('订单状态不正确');
//        }
        // scan 方法为拉起微信扫码支付
        $scan = app('wechat_pay')->scan([
            'out_trade_no' => $order->orderid,  // 商户订单流水号，与支付宝 out_trade_no 一样
            'total_fee' => $order->price * 100, // 与支付宝不同，微信支付的金额单位是分。
            'body' => '支付 联文检测 的订单：' . $order->orderid, // 订单描述
        ]);
        dd($scan);
        //把要转换的字符串作为QrCode的构造函数
        $qrCode = new QrCode($scan->code_url);
        //将生成的二维码图片数据以字符串形式输出，并带上相应的响应类型
        return response($qrCode->writeString(), 200, ['Content-Type' => $qrCode->getContentType()]);
    }

    public function wechatNotify()
    {
        // 校验回调参数是否正确
        $data = app('wechat_pay')->verify();
        // 找到对应的订单
        $order = Order::where('orderid', $data->out_trade_no)->first();
        // 订单不存在则告知微信支付
        if(!$order) {
            return 'fail';
        }
        // 订单已支付
        if($order->status == 1) {
            // 告知微信支付此订单已处理
            return app('wechat_pay')->success();
        }

        // 将订单标记为已支付
        $order->update([
            'date_pay' => Carbon::now(),
            'pay_type' => 'wechat',
            'payid' => $data->out_trade_no, //订单号
            'pay_price' => $data->total_fee / 100,//支付金额
            'status' => 1,
        ]);
//        redirect('pages.success');
        $this->afterPaid($order);
        return app('wechat_pay')->success();
    }

    protected function afterPaid(Order $order)
    {
        event(new OrderPaid($order));
    }
}
