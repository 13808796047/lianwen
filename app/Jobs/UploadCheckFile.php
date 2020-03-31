<?php

namespace App\Jobs;

use App\Handlers\OrderApiHandler;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UploadCheckFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;
    public $tries = 3;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }


    public function handle()
    {
        $api = app(OrderApiHandler::class);
        $result = $api->fileUpload($this->order);
        info('上传文件.....');
        if($result->code == 200) {
            dispatch(new CreateCheckOrder($this->order, $result));
        }
    }

    public function fail()
    {

    }
}