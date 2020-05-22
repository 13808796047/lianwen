<?php

namespace App\Http\Controllers;

use App\Jobs\Subscribed;
use App\Models\User;
use EasyWeChat\Factory;
use EasyWeChat\Kernel\Messages\Text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OfficialAccountController extends Controller
{
    protected $app;
    protected $prefix;

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
        $qrCode = $this->app->qrcode;
//        $prefix  = 'dev_order';
        $result = $qrCode->temporary('CC-' . auth()->user()->id, 3600 * 24);
        $url = $qrCode->url($result['ticket']);
        return response(compact('url'), 200);
    }

    public function serve()
    {
        $this->app->server->push(function($message) {
            info($message);
            if($message) {
                $method = \Str::camel('handle_' . $message['MsgType']);
                if(method_exists($this, $method)) {
                    $this->openid = $message['FromUserName'];
                    $this->officialAccount = $message['ToUserName'];
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

        $openId = $this->openid;
        // 微信用户信息
        $wxUser = $this->app->user->get($openId);
        $user = User::where('weixin_unionid', $wxUser['unionid'])->first();
        [$type, $id] = explode('-', $eventKey);
        $loginUser = User::find($id);
        $this->handleUser($wxUser, $loginUser);
    }


    /**
     * 取消订阅
     *
     * @param $event
     */
    protected function eventUnsubscribe($event)
    {
        $wxUser = User::whereWeixinOpenid($this->openid)->first();
        $wxUser->subscribe = 0;
        $wxUser->subscribe_time = null;
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
        //如果先授权登录,存在unionid
        $user = User::where('weixin_unionid', $wxUser['unionid'])->first();
        if(!$eventKey) {
            $type = 'CC';
            $loginUser = new User();
        } else {
            [$type, $id] = explode('-', $eventKey);
            $loginUser = User::find($id);
        }
        info('关注了');
        // 注册
        $this->handleUser($type, $wxUser, $user, $loginUser);
        if(!$loginUser->phone) {
            $this->dispatch(new Subscribed($this->officialAccount, $loginUser));
        }
    }

    public function handleUser($type, $wxUser, $user, $loginUser)
    {
        info($loginUser, ['1111']);
        if($type == 'JC') {
            if(!$user) {
                $invit_user = User::create([
                    'nick_name' => $wxUser['nickname'],
                    'avatar' => $wxUser['headimgurl'],
                    'weixin_openid' => $wxUser['openid'],
                    'weixin_unionid' => $wxUser['unionid'] ?: '',
                    'inviter' => $loginUser->id,
                    'subscribe' => $wxUser['subscribe'],
                    'subscribe_time' => $wxUser['subscribe_time'],
                ]);
                auth('web')->login($invit_user);
                //邀请人
                $loginUser->increaseJcTimes(5);
                $invit_user->increaseJcTimes(5);
            } else {
                $message = new Text('您已经注册过账号了!');

                $result = $this->app->customer_service->message($message)->to($invit_user->weixin_openid)->send();
            }
        }
        if($type == 'CC') {
            $loginUser->nick_name = $wxUser['nickname'];
            $loginUser->avatar = $wxUser['headimgurl'];
            $loginUser->subscribe = $wxUser['subscribe'];
            $loginUser->subscribe_time = $wxUser['subscribe_time'];
            $loginUser->weixin_unionid = $wxUser['unionid'];
            switch ($this->officialAccount) {
                case 'gh_192a416dfc80':
                    $loginUser->dev_weixin_openid = $wxUser['openid'];
                    break;
                case 'gh_caf405e63bb3':
                    $loginUser->wf_weixin_openid = $wxUser['openid'];
                    break;
                case 'gh_1a157bde21a9':
                    $loginUser->wp_weixin_openid = $wxUser['openid'];
                    break;
                default:
                    $loginUser->cn_weixin_openid = $wxUser['openid'];
            }
            $loginUser->save();
        }
    }
}
