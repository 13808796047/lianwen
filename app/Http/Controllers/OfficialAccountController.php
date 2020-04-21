<?php

namespace App\Http\Controllers;

use App\Models\User;
use EasyWeChat\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OfficialAccountController extends Controller
{
    protected $app;

    public function __construct()
    {
        $this->app = app('official_account');
    }

    /**
     * 获取二维码图片
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // 有效期 1 天的二维码
        $qrCode = $this->app->qrcode;
        $result = $qrCode->temporary(auth()->user()->id, 3600 * 24);
        $url = $qrCode->url($result['ticket']);
        return response(compact('url'), 200);
    }

    public function serve()
    {
        $this->app->server->push(function($message) {
            if($message) {
                $method = \Str::camel('handle_' . $message['MsgType']);
                if(method_exists($this, $method)) {
                    $this->openid = $message['FromUserName'];
                    return call_user_func_array([$this, $method], [$message]);
                }

            }
            return "您好！欢迎使用论文检测服务";
        });

        return $this->app->server->serve();
    }

    /**
     * 事件引导处理方法（事件有许多，拆分处理）
     *
     * @param $event
     *
     * @return mixed
     */
    protected function handleEvent($event)
    {
        $method = \Str::camel('event_' . $event['Event']);

        if(method_exists($this, $method)) {
            return call_user_func_array([$this, $method], [$event]);
        }
    }

    /**
     * 扫描带参二维码事件
     *
     * @param $event
     */
    public function eventSCAN($event)
    {
        if(empty($event['EventKey'])) {
            return;
        }
        $eventKey = $event['EventKey'];
        $user = User::FindOrFail($eventKey);
        $openId = $this->openid;
        // 微信用户信息
        $wxUser = $this->app->user->get($openId);
        // 注册
//        $nickname = $this->filterEmoji($wxUser['nickname']);
        $result = \DB::transaction(function() use ($openId, $user, $wxUser) {
            // 用户
            $user->update([
                'nick_name' => $wxUser['nickname'],
                'avatar' => $wxUser['headimgurl'],
                'weixin_openid' => $wxUser['openid'],
                'weixin_unionid' => $wxUser['unionid'],
            ]);
            info('user', [$user->phone]);
        });
        info('扫码关注了~~~', [$result]);
    }

    /**
     * 取消订阅
     *
     * @param $event
     */
    protected function eventUnsubscribe($event)
    {
        $wxUser = User::whereWeixinOpenid($this->openid)->first();
        $wxUser->weixin_openid = '';
        $wxUser->save();
    }

    /**
     * 订阅
     *
     * @param $event
     *
     * @throws \Throwable
     */
    protected function eventSubscribe($event)
    {
        $openId = $this->openid;
        if(empty($event['EventKey'])) {
            return;
        }
        // 关注事件的场景值会带一个前缀需要去掉
        if($event['Event'] == 'subscribe') {
            $eventKey = \Str::after($event['EventKey'], 'qrscene_');
        }
        // 微信用户信息
        $wxUser = $this->app->user->get($openId);
        // 注册

        $user = User::FindOrFail($eventKey);
        $result = \DB::transaction(function() use ($openId, $user, $wxUser) {
            // 用户
            $user->update([
                'nick_name' => $wxUser['nickname'],
                'avatar' => $wxUser['headimgurl'],
                'weixin_openid' => $wxUser['openid'],
                'weixin_unionid' => $wxUser['unionid'],
            ]);
        });
    }
}
