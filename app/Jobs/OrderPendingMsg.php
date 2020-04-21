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
            'keyword2' => ['value' => OrderEnum::getStatusName($this->order->status), 'color' => '#173177'],
            'keyword3' => ['value' => $this->order->created_at->format("Y-m-d"), 'color' => '#173177'],
            'keyword4' => ['value' => $this->order->category->name, 'color' => '#173177'],
            'keyword5' => ['value' => $this->order->price, 'color' => '#173177'],
            'remark' => ['value' => '点击查看详情，如已完成支付请忽略！', 'color' => '#173177']
        ];
        app('official_account')->template_message->send([
            'touser' => $user->weixin_openid,
            'template_id' => '8Fyk5ojTngSDx9lpETPCUYvjYte7ycubeqsTAxxERh0',
            'data' => $data,
        ]);
    }
}
