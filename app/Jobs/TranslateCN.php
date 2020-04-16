<?php

namespace App\Jobs;

use App\Handlers\AutoCheckHandler;
use App\Models\AutoCheck;
use Illuminate\Bus\Dispatcher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class TranslateCN implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $autoCheck;
    protected $autoHandle;

    public function __construct(AutoCheck $autoCheck)
    {
        $this->autoCheck = $autoCheck;
        $this->autoHandle = app(AutoCheckHandler::class);
    }


    public function handle()
    {
        $result = $this->autoHandle->translate_cn($this->autoCheck->content_before);
        if($result_en['trans_result'][0]['dst']) {
            DB::table('auto_checks')->where('id', $this->autoCheck->id)->update(['content_after' => $result_en['trans_result'][0]['dst']]);
        }
    }
}