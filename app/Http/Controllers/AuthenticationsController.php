<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationsController extends Controller
{
    public function oauth($type, Request $request)
    {
        return \Socialite::with($type)->redirect();
    }

    public function callback($type, Request $request)
    {
        return '测试';
//        $oauthUser = \Socialite::with($type)->user();
//        dd($oauthUser);
    }
}
