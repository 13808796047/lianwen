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

    public function __construct(Order $order)
    {
        $this->order = $order;

    }

    //定义这个任务类具体的执行逻辑
    //当队列处理器从队列中取出任务时，会调用handle()方法
    public function handle()
    {
        info('获取报告....');
        $api = app(OrderApiHandler::class);
        $result = $api->getOrder($this->order->api_orderid);
        if($result->code == 200) {
            $file = $api->downloadReport($this->order->api_orderid);
            $path = 'downloads/report-' . $this->order->api_orderid . '.zip';
            \Storage::delete($path);
            \Storage::put($path, $file);
            info(storage_path('app/' . $path));
            //解压zip文件
            $zip = new ZipArchive();
            if($zip->open(storage_path('/app/' . $path)) === true) {
                switch ($result->data->order->cid) {
                    case 20:
                    case 22:
                    case 23:
                    case 21:
                        $file_name = $result->data->order->title . "（详细版）.pdf";
                        break;
                    case 9:
                        $file_name = "PaperPass-旗舰版-检测报告\简明打印版.pdf";
                        break;
                    case 5:
                    case 6:
                    case 7:
                    case 8:
                        $file_name = $result->data->order->title . "_原文对照报告.pdf";
                        break;
                    default:
                        $file_name = "PDF报告.pdf";
                }
                $content = $zip->getFromName($file_name);

                if(!$content) {
                    $report_pdf_path = '';
                }
                $report_pdf_path = public_path('/pdf/') . $this->order->orderid . '.pdf';
                \Storage::delete($report_pdf_path);
                chmod(public_path('/pdf/'), 0777);
                file_put_contents($report_pdf_path, $content);
                $zip->close();
            }
            $report = $api->extractReportDetail($this->order->api_orderid);
            info('报告接口数据', $report);
            if($report) {
                \DB::transaction(function() use ($path, $report, $result, $report_pdf_path) {
                    $this->order->update([
                        'report_path' => $path,
                        'report_pdf_path' => $report_pdf_path,
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
