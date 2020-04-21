<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderPendingMsg implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }


    public function handle()
    {
        $user = User::FindOrFail($this->order->userid);
        if(!$user->weixin_openid) {
            return;
        }
        $data = [
            'first' => '您有一个订单尚未完成支付，支付后开始检测',
            'keyword1' => ['value' => $this->order->title, 'color' => '#173177'],
        ];
        app('official_account')->template_message->send([
            'touser' => $user->weixin_openid,
            'template_id' => '8Fyk5ojTngSDx9lpETPCUYvjYte7ycubeqsTAxxERh0',
            'data' => $data,
        ]);
    }
}
