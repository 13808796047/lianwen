<?php


namespace App\Handlers;


use GuzzleHttp\Client;

class AutoCheckHandler
{
    protected $http;
    protected $api;
    protected $appid;
    protected $key;
    protected $sign;

    public function __construct()
    {
        $this->http = new Client;
        $this->api = 'http://api.fanyi.baidu.com/api/trans/vip/translate?';
        $config = array_rand(config('services.baidu_translate'), 1);
        $this->appid = $config['appid'];
        $this->key = $config('key');
        //根据文档生成sign
        $this->sign = md5($appid . $text . $slat . $key);
    }

    public function translate_en($text)
    {
        $query = http_build_query([
            'q' => $text,
            "from" => 'zh',
            "to" => "en",
            "appid" => $this->appid,
            "salt" => $salt,
            "sign" => $this->sign
        ]);
        $response = $this->http->get($this->api . $query);
        return json_decode($response->getBody(), true);
    }

    public function translate_cn($text)
    {
        $query = http_build_query([
            'q' => $text,
            "from" => 'en',
            "to" => "zh",
            "appid" => $this->appid,
            "salt" => $salt,
            "sign" => $this->sign
        ]);
        $response = $this->http->get($this->api . $query);
        return json_decode($response->getBody(), true);
    }
}
