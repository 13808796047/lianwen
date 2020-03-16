<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidRequestException;
use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use Yansongda\Pay\Pay;

class PaymentsController extends Controller
{
    protected $alipayConfig;

    public function __construct()
    {
        $this->alipayConfig = config('pay.alipay');
        $this->alipayConfig['notify_url'] = 'https://dev.lianwen.com/api/v1/payments/alipay/notify';
        $this->alipayConfig['return_url'] = 'https://dev.lianwen.com/api/v1/payments/alipay/return';

    }

    public function alipayScan()
    {
//        if($order->status == 1 || $order->del) {
//            throw new InvalidRequestException('订单状态不正确!');
//        }

        // 调用支付宝的网页支付
        $scan = Pay::alipay($this->alipayConfig)->scan([
            'out_trade_no' => time(), // 订单编号，需保证在商户端不重复
            'total_amount' => 0.01, // 订单金额，单位元，支持小数点后两位
            'subject' => '支付 联文检测 的订单：' . time(), // 订单标题
        ]);
        dd($scan);
        //把要转换的字符串作为QrCode的构造函数
        $qrCode = new QrCode($scan->code);
        //将生成的二维码图片数据以字符串形式输出，并带上相应的响应类型
        return response($qrCode->writeString(), 200, ['Content-Type' => $qrCode->getContentType()]);
    }
}
