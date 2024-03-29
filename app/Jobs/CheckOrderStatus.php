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
use function Psy\debug;

class CheckOrderStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;
    protected $timeout = 120;
    protected $tries = 3;

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
        if($result->code == 200) {
            $file = $api->downloadReport($this->order->api_orderid);

            $path = 'downloads/report-' . $this->order->api_orderid . '.zip';
            \Storage::delete($path);
            \Storage::put($path, $file);
            //存储pdf
            $content = $api->extractReportPdf($this->order->api_orderid);
            file_put_contents(public_path('/pdf/') . $this->order->orderid . '.pdf', $content);
            $report_pdf_path = config('app.url') . '/pdf/' . $this->order->orderid . '.pdf';
            \DB::transaction(function() use ($path, $result, $report_pdf_path) {
                $this->order->update([
                    'report_path' => $path,
                    'report_pdf_path' => $report_pdf_path,
                    'rate' => str_replace('%', '', $result->data->orderCheck->apiResultSemblance),
                ]);
                if($this->order->status == 4) {
                    dispatch(new OrderCheckedMsg($this->order));
                }
                try {
                    $report = $api->extractReportDetail($this->order->api_orderid);
                    $content = $report->data->content;
                } catch (\Exception $e) {
                    $content = '';
                }
                $this->order->report()->create([
                    'content' => $content
                ]);
            });
        }
    }
}
