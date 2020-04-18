<?php

namespace App\Http\Controllers;

use EasyWeChat\Factory;
use Illuminate\Http\Request;

class OfficialAccountController extends Controller
{
    protected $app;

    public function __construct()
    {
        $this->app = Factory::officialAccount(config('wechat.official_account.default'));
    }

    /**
     * 获取二维码图片
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // 有效期 1 天的二维码
        $qrCode = $this->app->qrcode;
        $result = $qrCode->temporary('wechat', 3600 * 24);
        $url = $qrCode->url($result['ticket']);
        return response(compact('url'), 200);
    }

    public function serve()
    {
        $this->app->server->push(function($message) {
            if($message['Event'] === 'SCAN') {
                $openid = $message['FromUserName'];
                $user = auth()->user();
                $user->update([
                    'weixin_openid' => $openid
                ]);
                return redirect()->back();
            } else {
                // TODO： 用户不存在时，可以直接回返登录失败，也可以创建新的用户并登录该用户再返回
                return '关注失败';
            }
        }, \EasyWeChat\Kernel\Messages\Message::EVENT);

        return $this->app->server->serve();
    }
}
