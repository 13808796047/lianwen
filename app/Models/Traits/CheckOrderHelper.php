<?php

namespace App\Models\Traits;

use App\Handlers\OrderApiHandler;
use App\Models\Enum\OrderEnum;

trait CheckOrderHelper
{
    public function getOrderStatus()
    {
        $api = app(OrderApiHandler::class);
        $apiOrder = $api->getOrder($this->api_orderid);
        //判断对应的订单是否已经被支付
        if($this->status == OrderEnum::CHECKED) {
            $file = $api->downloadReport($this->api_orderid);
            $path = 'downloads/report-' . $this->api_orderid . '.zip';
            $result = \Storage::put($path, $file);
            $report = $api->extractReportDetail($this->api_orderid);
            if($result) {
                \DB::transaction(function() use ($path, $report) {
                    $this->update([
                        'report_path' => $path
                    ]);
                    $this->report()->create([
                        'content' => $report->data->content
                    ]);
                });
            }
            return;
        }

        if($apiOrder->data->order->status == 7) {
            $status = OrderEnum::INLINE;
        } elseif($apiOrder->data->order->status == 9) {
            $status = OrderEnum::CHECKED;
        } else {
            $status = OrderEnum::TIMEOUT;
        }
        \DB::transaction(function() use ($apiOrder, $status) {
            $this->update([
                'rate' => $apiOrder->data->orderCheck->apiResultSemblance,
                'status' => $status,
            ]);
        });
    }
}
