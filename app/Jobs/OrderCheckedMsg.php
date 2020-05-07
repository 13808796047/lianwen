<?php

namespace App\Jobs;

use App\Models\Enum\OrderEnum;
use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderCheckedMsg implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle()
    {
        if($this->order->user->weixin_openid && $this->order->status == 4) {
            return;
        }
        $data = [
            'first' => '您的论文已经检测完成,点击查看结果',
            'keyword1' => ['value' => $this->order->title, 'color' => '#173177'],
            'keyword2' => ['value' => $this->order->category->name, 'color' => '#173177'],
            'keyword3' => ['value' => $this->order->rate, 'color' => '#173177'],
            'keyword4' => ['value' => $this->order->created_at->format("Y-m-d H:i:s"), 'color' => '#173177'],
            'remark' => ['value' => '点击查看详情！', 'color' => '#173177']
        ];
        app('official_account')->template_message->send([
            'touser' => $user->weixin_openid,
            'template_id' => 'IKyhivjep0fGj-oaCRdfLBRkRSSvESl5lRUQVCXOM2o',
            'url' => 'https://wanfang.lianwen.com',
            'miniprogram' => [
                'appid' => 'wx6340d7d2fead020b',
                'pagepath' => 'pages/lookup/lookup',
            ],
            'data' => $data,
        ]);
    }
}
