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
        $domain = \request()->getHost();
        switch ($domain) {
            case 'mp.cnweipu.com':
                $config = config('wechat.official_account.mp');
                break;
            default:
                $config = config('wechat.official_account.default');
        }
        $this->app = Factory::officialAccount($config);
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
            info('公众号触发事件了....', $message);
            if($message) {
                $method = \Str::camel('handle_' . $message['MsgType']);

                if(method_exists($this, $method)) {
                    $this->openid = $message['FromUserName'];

                    return call_user_func_array([$this, $method], [$message]);
                }

                Log::info('无此处理方法:' . $method);
            }
            return "您好！欢迎使用 联文检测";
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
        Log::info('事件参数：', [$event]);

        $method = \Str::camel('event_' . $event['Event']);
        Log::info('处理方法:' . $method);

        if(method_exists($this, $method)) {
            return call_user_func_array([$this, $method], [$event]);
        }

        Log::info('无此事件处理方法:' . $method);
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
            ]);
        });
    }

    /**
     * 取消订阅
     *
     * @param $event
     */
    protected function eventUnsubscribe($event)
    {
        Log::info('取消关注公众号了...' . $this->openid);
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
        Log::info('关注公众号了...' . $this->openid);
        $openId = $this->openid;
        if(empty($event['EventKey'])) {
            return;
        }
        // 关注事件的场景值会带一个前缀需要去掉
        if($event['Event'] == 'subscribe') {
            $eventKey = \Str::after($event['EventKey'], 'qrscene_');
        }
        info('eventKey', [$eventKey]);
        // 微信用户信息
        $wxUser = $this->app->user->get($openId);
        // 注册

        $user = User::FindOrFail($eventKey);
        $result = \DB::transaction(function() use ($openId, $user, $wxUser) {
            // 用户
            Log::info('用户', [$user->phone]);
            $user->update([
                'nick_name' => $wxUser['nickname'],
                'avatar' => $wxUser['headimgurl'],
                'weixin_openid' => $wxUser['openid'],
            ]);
            Log::info('用户关注成功 openid：' . $openId);

        });

        Log::debug('SQL 错误: ', [$result]);
    }
}
