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
    protected $api;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->api = app(OrderApiHandler::class);
    }

    //定义这个任务类具体的执行逻辑
    //当队列处理器从队列中取出任务时，会调用handle()方法
    public function handle()
    {
        $apiOrder = $this->api->getOrder($this->order->api_orderid);
        //判断对应的订单是否已经被支付
        if($this->order->status == OrderEnum::CHECKED) {
            $file = $this->api->downloadReport($this->order->api_orderid);
            $path = 'downloads/report-' . $this->order->api_orderid . '.zip';
            $result = \Storage::put($path, $file);
            $report = $this->api->extractReportDetail($this->order->api_orderid);
            if($report) {
                \DB::transaction(function() use ($path, $report) {
                    $this->order->update([
                        'report_path' => $path,
                        'rate' => $apiOrder->data->orderCheck->apiResultSemblance,
                    ]);
                    $this->order->report()->create([
                        'content' => $report->data->content
                    ]);
                });
            }
            return;
        }
        switch ($apiOrder->data->order->status) {
            case 7:
                $status = OrderEnum::INLINE;
                break;
            case 9:
                $status = OrderEnum::CHECKED;
                break;
            default:
                $status = OrderEnum::CHECKING;
        }
        \DB::transaction(function() use ($status) {
            $this->order->update([
                'status' => $status,
            ]);
        });
    }
}
