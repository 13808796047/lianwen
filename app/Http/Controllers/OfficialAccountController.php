<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfficialAccountController extends Controller
{
    protected $app;

    public function __construct()
    {
        $this->app = Factory::officialAccount(config('wechat.official_account.default'));
    }

    /**
     * 获取二维码图片
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        //查询cookie,如果没有就重新生成一次
    }

    public function callBack()
    {
        try {
            $user = $this->app->oauth->user();
            session('wechat_user', $user->toArray);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
