<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class InvitOfficialController extends Controller
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
    public function index(Request $request)
    {
        // 有效期 1 天的二维码
        if($request->has('uid')) {
            $uid = $request->uid;
        }
        $qrCode = $this->app->qrcode;
        $result = $qrCode->temporary($uid, 3600 * 24);
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
//
        $openId = $this->openid;
        // 微信用户信息
        $wxUser = $this->app->user->get($openId);
        //如果先授权登录,存在unionid
        $user = User::where('weixin_unionid', $wxUser['unionid'])->first();
        if(!$user) {
            $user = User::create([
                'nick_name' => $wxUser['nickname'],
                'avatar' => $wxUser['headimgurl'],
                'weixin_openid' => $wxUser['openid'],
                'weixin_unionid' => $wxUser['unionid'] ?: ''
            ]);
            auth('web')->login($user);
        }
        if($request->has('uid')) {
            //邀请人
            $inviter = User::findOrFail($request->uid);
            $inviter->increaseJcTimes(5);
            $user->increaseJcTimes(5);
        }

    }
}
