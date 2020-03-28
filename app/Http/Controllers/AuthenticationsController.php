<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Overtrue\Socialite\SocialiteManager;

class AuthenticationsController extends Controller
{
    protected $app;

    public function __construct()
    {
        $config = [
            'wechat' => [
                'client_id' => 'wxdaab22b871fc3982', // AppID
                'client_secret' => '6680c8ec8bd33997d3f709b889f36d17', // AppSecret
                'redirect' => 'https://dev.lianwen.com/oauth/wechat/callback',
            ]
        ];
        $this->app = new SocialiteManager($config);
    }

    public function oauth($type, Request $request)
    {

        return $this->app->driver($type)->redirect();
    }

    public function callback($type, Request $request)
    {
        $oauthUser = $this->app->driver($type)->user();
        switch ($type) {
            case 'wechat':
                $unionid = $oauthUser->getOriginal()['unionid'] ?: null;
                if($unionid) {
                    $user = User::where('weixin_unionid', $unionid)->first();
                } else {
                    $user = User::where('weixin_openid', $oauthUser->getOriginal()['openid'])->first();
                }
                // 没有用户，默认创建一个用户
                if(!$user) {
                    $user = User::create([
                        'nick_name' => $oauthUser['nickname'],
                        'avatar' => $oauthUser['avatar'],
                        'weixin_openid' => $oauthUser->getOriginal()['openid'],
                        'weixin_unionid' => $unionid,
                    ]);
                }
                break;
        }
        auth('web')->login($user);
        return redirect()->to('/');
    }

//    public function accountLogin(Request $request)
//    {
//        $credentials = $this->validate($request, [
//            'phone' => 'required|unique:users|max:50',
//            'password' => 'required|confirmed|min:6'
//        ]);
//        $credentials['phone'] = $request->phone;
//        $credentials['password'] = $request->password;
//        if(\Auth::attempt($credentials)) {
//            session()->flash('success', '欢迎回来！');
//            return redirect()->route('pages.index');
//        } else {
//            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
//            return redirect()->back()->withInput();
//        }
//    }
//
//    public function mobileLogin(Request $request)
//    {
//        $validatedData = $request->validate([
//            'phone' => 'required|unique:users|max:50',
//            'verification_key' => 'required',
//            'verification_code' => 'required',
//        ]);
//
//        $verifyData = \Cache::get($request->verification_key);
//        if(!$verifyData) {
//            abort(403, '验证码已失效');
//        }
//        if(!hash_equals($verifyData['code'], $request->verification_code)) {
//            // 返回401
//            throw new AuthenticationException('验证码错误');
//        }
//        $phone = $verifyData['phone'];
//
//    }
}
