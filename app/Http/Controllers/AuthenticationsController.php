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
                        'name' => $oauthUser->getNickname(),
                        'avatar' => $oauthUser->getAvatar(),
                        'weixin_openid' => $oauthUser->getId(),
                        'weixin_unionid' => $oauthUser->getOriginal()['openid'],
                    ]);
                }
                break;
        }
        auth('web')->login($user);
        return redirect()->to('pages.index');
    }
}
