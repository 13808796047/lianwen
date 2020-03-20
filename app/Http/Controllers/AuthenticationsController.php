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
                $unionid = $oauthUser->offsetExists('unionid') ? $oauthUser->offsetGet('unionid') : null;
                dd($unionid);
        }
    }
}
