<?php

namespace App\Http\Controllers;

use App\Models\User;
use EasyWeChat\Factory;
use Illuminate\Http\Request;

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
        $result = $qrCode->temporary('wechat', 3600 * 24);
        $url = $qrCode->url($result['ticket']);
        return response(compact('url'), 200);
    }

    public function serve()
    {
        info("request arrived");
        $this->app->server->push(function($message) {
            return "您好！欢迎使用 EasyWeChat!";
        });
//        $accessToken = $this->app->access_token;
//        $token = $accessToken->getToken(); // token 数组  token['access_token'] 字符串
//        $this->app['access_token']->setToken($token['access_token']);
//        info('公众号触发事件了....');
//        $this->app->server->push(function($message) {
//            info('公众号触发事件了....', $message);
//            if($message) {
//                $method = camel_case('handle_' . $message['MsgType']);
//                if(method_exists($this, $method)) {
//                    $this->openid = $message['FromUserName'];
//
//                    return call_user_func_array([$this, $method], [$message]);
//                }
//                Log::info('无此处理方法:' . $method);
//            }
//            return "您好！欢迎使用 联文检测";
//        });

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

        $method = camel_case('event_' . $event['Event']);
        Log::info('处理方法:' . $method);

        if(method_exists($this, $method)) {
            return call_user_func_array([$this, $method], [$event]);
        }

        Log::info('无此事件处理方法:' . $method);
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

        // 微信用户信息
        $wxUser = $this->app->user->get($openId);
        // 注册
        $nickname = $this->filterEmoji($wxUser['nickname']);

        $result = DB::transaction(function() use ($openId, $event, $nickname, $wxUser) {


            // 用户
            $user = auth()->user();
            $user->update([
                'nick_name' => $nickname,
                'avatar' => $wxUser['headimgurl'],
                'weixin_openid' => $wxUser['openid'],
            ]);
            Log::info('用户关注成功 openid：' . $openId);

        });

        Log::debug('SQL 错误: ', [$result]);
    }
}
