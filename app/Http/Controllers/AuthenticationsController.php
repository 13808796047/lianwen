<?php

namespace App\Http\Controllers;

use EasyWeChat\Factory;
use Illuminate\Http\Request;

class AuthenticationsController extends Controller
{
    protected $app;

    public function __construct()
    {
        $config = [
            'app_id' => 'wxdaab22b871fc3982', // AppID
            'secret' => '6680c8ec8bd33997d3f709b889f36d17', // AppSecret
            'oauth' => [
                'scopes' => ['snsapi_userinfo'],
                'callback' => '/oauth/weixin/callback',
            ],
        ];
        $this->app = Factory::officialAccount($config);
    }

    public function oauth($type, Request $request)
    {
        return $this->app->oauth->redirect();
    }

    public function callback($type, Request $request)
    {
        return '测试';
//        $oauthUser = \Socialite::with($type)->user();
//        dd($oauthUser);
    }
}
