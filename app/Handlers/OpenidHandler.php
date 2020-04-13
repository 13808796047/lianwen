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

    public function getOpenid($code)
    {
        $config = config('pay.wechat');
        $query = [
            'appid' => $config['app_id'],
            'secret' => 'b4e08c848e9c1f9114ead07b6549d641',
            'code' => $code,
            'grant_type' => 'authorization_code',
        ];
        $response = $this->http->request('GET', ' https://api.weixin.qq.com/sns/oauth2/access_token', [$query]);
        return json_decode($response->getbody()->getContents());
    }

}
