<?php

namespace App\Jobs;

use App\Handlers\OrderApiHandler;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckOrderStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
        //设置延迟的时间，delay()方法的参数代表多少秒之后执行
//        $this->delay($delay);

    }

    //定义这个任务类具体的执行逻辑
    //当队列处理器从队列中取出任务时，会调用handle()方法
    public function handle()
    {
        $api = new OrderApiHandler();
        $order = $api->getOrder($this->order->api_orderid);
        //判断对应的订单是否已经被支付
        if($this->status == 5) {
            $file = $api->downloadReport($this->order->api_orderid);
            dd($file);
            return;
        }

        if($order->data->order->status == 7) {
            $status = 3;
        } elseif($order->data->order->status == 9) {
            $status = 5;
        } else {
            $status = 4;
        }
        \DB::transaction(function() {
            $this->order->update([
                'rate' => $order->data->orderCheck->apiResultSemblance,
                'status' => $status,
            ]);
        });
    }
}
