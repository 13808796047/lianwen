<?php

namespace App\Jobs;

use App\Models\Enum\OrderEnum;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Subscribed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $uri;

    public function __construct($uri, User $user)
    {
        $this->uri = $uri;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        switch ($this->uri) {
            case 'dev':
                $openid = $this->user->dev_weixin_openid;
                $template_id = env('DEV_WECHAT_OFFICIAL_ACCOUNT_BOUNDPHONE_TEMPLATE_ID');
                $appid = env('DEV_MINIPROGRAM_APPID');
                $pagePath = env('DEV_MINIPROGRAM_BINDPHONE_URL');
                $data = [
                    'first' => '您未绑定手机号，绑定手机号后可接收网站订单状态。',
                    'keyword1' => ['value' => $this->user->nick_name, 'color' => '#173177'],
                    'keyword2' => ['value' => '未绑定', 'color' => '#173177'],
                    'remark' => ['value' => '绑定手机号！', 'color' => '#173177']
                ];
                break;
        }
        if($openid) {
            app('official_account')->template_message->send([
                'touser' => $openid,
                'template_id' => $template_id,
//                'url' => 'https://wap.lianwen.com/bading?openid=' . $this->order->user->weixin_openid,
                'miniprogram' => [
                    'appid' => $appid,
                    'pagepath' => $pagePath,
                ],
                'data' => $data,
            ]);
        }
    }
}
