<?php

namespace App\Listeners;

use App\Events\OrderPaid;
use App\Handlers\OrderApiHandler;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckDoc implements ShouldQueue
{
    public $api;

    public function __construct(OrderApiHandler $apiHandler)
    {
        $this->api = $apiHandler;
    }

    public function handle(OrderPaid $event)
    {

        //从事件对象中取出对应的订单
        $order = $event->getOrder();
        //调用上传文件接口

        $result = $this->api->fileUpload($order);
        //调用创建apiOrder
        $apiOrderId = $this->api->createOrder($order, $result);
        //调用获取订单
        $apiOrder = $this->api->getOrder($apiOrderId);
        if($apiOrder->code == 200) {
            $order->update([
                'rate' => $apiOrder->data->orderCheck->apiResultSemblance,
                'api_orderid' => $apiOrder->data->order->orderId,
                'status' => 4,
            ]);
        }
    }
}
