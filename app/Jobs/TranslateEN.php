<?php

namespace App\Jobs;

use App\Handlers\AutoCheckHandler;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TranslateEN implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $autoCheck;
    protected $autoHandle;

    public function __construct()
    {
        $this->autoCheck = $autoCheck;
        $this->autoHandle = app(AutoCheckHandler::class);
    }


    public function handle()
    {
        $result = $this->autoHandle->translate_en($this->autoCheck->content_before);
        if($result_en['trans_result'][0]['dst']) {
            dispatch(new TranslateCN($this->autoCheck))->delay(now()->addSeconds());
        }
    }
}
