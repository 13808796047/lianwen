<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function oauth()
    {
        dd('微信登录');
    }

    public function callback()
    {

    }
}
