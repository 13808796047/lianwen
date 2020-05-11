<?php

namespace App\Jobs;

use App\Handlers\AutoCheckHandler;
use App\Models\AutoCheck;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TranslateEN implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $autoCheck;

    public function __construct(AutoCheck $autoCheck)
    {
        $this->autoCheck = $autoCheck;
    }


    public function handle()
    {
        $result = app(AutoCheckHandler::class)->translate_en($this->autoCheck->content_before);
        if($result['trans_result'][0]['dst']) {
            dispatch(new TranslateCN($this->autoCheck, $result['trans_result'][0]['dst']))->delay(now()->addSeconds(1));
        }
    }
}
