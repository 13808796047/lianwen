<?php

namespace App\Jobs;

use App\Handlers\OrderApiHandler;
use App\Models\Enum\OrderEnum;
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

    }

    //定义这个任务类具体的执行逻辑
    //当队列处理器从队列中取出任务时，会调用handle()方法
    public function handle()
    {
        $api = app(OrderApiHandler::class);

        //判断对应的订单是否已经被支付
        if($this->order->status == OrderEnum::CHECKED) {
            $file = $api->downloadReport($this->order->api_orderid);
            $path = 'downloads/report-' . $this->order->api_orderid . '.zip';
            $result = \Storage::put($path, $file);
            $report = $api->extractReportDetail($this->order->api_orderid);
            if($result) {
                \DB::transaction(function() use ($path, $report) {
                    $this->order->update([
                        'report_path' => $path
                    ]);
                    $this->order->report()->create([
                        'content' => $report->data->content
                    ]);
                });
            }
            return;
        }

        if($order->data->order->status == 7) {
            $status = OrderEnum::INLINE;
        } elseif($order->data->order->status == 9) {
            $status = OrderEnum::CHECKED;
        } else {
            $status = OrderEnum::TIMEOUT;
        }
        \DB::transaction(function() use ($order, $status) {
            $this->order->update([
                'rate' => $order->data->orderCheck->apiResultSemblance,
                'status' => $status,
            ]);
        });
    }
}
