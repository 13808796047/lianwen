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
use PhpOffice\PhpWord\Shared\ZipArchive;

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
        $result = $api->getOrder($this->order->api_orderid);
        info('获取报告....');
        if($result->code == 200) {
            $file = $api->downloadReport($this->order->api_orderid);
            $path = 'downloads/report-' . $this->order->api_orderid . '.zip';
            \Storage::delete($path);
            \Storage::put($path, $file);
            info(storage_path('app/$path'));
            //解压zip文件
            $zip = new ZipArchive();
            if($zip->open(storage_path('app/$path')) === true) {
                $zip->extractTo(storage_path('app/pdfs/'));
                $zip->close();
            }
            $report = $api->extractReportDetail($this->order->api_orderid);
            if($report) {
                \DB::transaction(function() use ($path, $report, $result) {
                    $this->order->update([
                        'report_path' => $path,
                        'rate' => $result->data->orderCheck->apiResultSemblance,
                    ]);
                    $this->order->report()->create([
                        'content' => $report->data->content
                    ]);
                });
            }
        }
    }
}
