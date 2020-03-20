<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PagesController extends Controller
{
    protected $app;

    public function __construct()
    {
        $this->app = app('wechat.official_account');
    }

    public function index()
    {
        $result = $this->app->qrcode->temporary('foo', 600);
        $qrcodeUrl = $this->app->qrcode->url($result['ticket']);
        return view('pages.index', compact('qrcodeUrl'));
    }
}
