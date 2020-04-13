<?php


namespace App\Handlers;


use GuzzleHttp\Client;

class OpenidHandler
{
    protected $http;

    public function __construct()
    {
        // 实例化 HTTP 客户端
        $this->http = new Client();
    }

    public function getOpenid()
    {
        $config = config('pay.wechat');
        $query = [
            'appid' => $config['app_id'],
            'redirect_uri' => 'dev.lianwen.com',
            'response_type' => 'code',
            'scope' => 'snsapi_base',
            'state' => '123#wechat_redirect',
        ];
        $response = $this->http->get(' https://open.weixin.qq.com/connect/oauth2/authorize', $query);
        dd($response);
        return json_decode($response->getbody()->getContents());
    }
}
