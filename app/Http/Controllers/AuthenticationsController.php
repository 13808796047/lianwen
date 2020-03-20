<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Overtrue\Socialite\SocialiteManager;

class AuthenticationsController extends Controller
{
    protected $app;

    public function __construct()
    {
        $config = [
            'wechat' => [
                'app_id' => 'wxdaab22b871fc3982', // AppID
                'secret' => '6680c8ec8bd33997d3f709b889f36d17', // AppSecret
                'redirect' => 'https://dev.lianwen.com/auth/weixin/callback',
            ]
        ];
        $this->app = new SocialiteManager($config);
    }

    public function oauth($type, Request $request)
    {

        return $this->app->driver('wechat')->redirect();
    }

    public function callback($type, Request $request)
    {
        return '测试';
//        $oauthUser = \Socialite::with($type)->user();
//        dd($oauthUser);
    }
}
