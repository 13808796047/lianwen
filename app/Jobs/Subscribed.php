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
    protected $officialAccount;

    public function __construct($officialAccount, User $user)
    {
        $this->$officialAccount = $officialAccount;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        info($this->officialAccount);
        $data = [
            'first' => '您未绑定手机号，绑定手机号后可接收网站订单状态。',
            'keyword1' => ['value' => $this->user->nick_name, 'color' => '#173177'],
            'keyword2' => ['value' => '未绑定', 'color' => '#173177'],
            'remark' => ['value' => '绑定手机号！', 'color' => '#173177']
        ];
        switch ($this->officialAccount) {
            case 'gh_192a416dfc80':
                $openid = $this->user->dev_weixin_openid;
                $template_id = config('wechat.official_account.dev.templates.subscribed.template_id');
                $appid = config('wechat.official_account.dev.templates.subscribed.appid');
                $pagePath = config('wechat.official_account.dev.templates.subscribed.page_path');
                break;
            case 'gh_caf405e63bb3':
                $openid = $this->user->wf_weixin_openid;
                $template_id = config('wechat.official_account.wf.templates.subscribed.template_id');
                $appid = config('wechat.official_account.wf.templates.subscribed.appid');
                $pagePath = config('wechat.official_account.wf.templates.subscribed.page_path');
                break;
            case 'gh_192a416dfc80':
                $openid = $this->user->wp_weixin_openid;
                $template_id = config('wechat.official_account.wp.templates.subscribed.template_id');
                $appid = config('wechat.official_account.wp.templates.subscribed.appid');
                $pagePath = config('wechat.official_account.wp.templates.subscribed.page_path');
                break;
            default:
                $openid = $this->user->cn_weixin_openid;
                $template_id = config('wechat.official_account.cn.templates.subscribed.template_id');
                $appid = config('wechat.official_account.cn.templates.subscribed.appid');
                $pagePath = config('wechat.official_account.cn.templates.subscribed.page_path');
        }
        info($data, [$openid]);
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
