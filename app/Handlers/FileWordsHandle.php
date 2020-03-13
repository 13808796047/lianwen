<?php


namespace App\Handlers;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class FileWordsHandle
{
    public function getWords($title, $author, $file)
    {
        // 实例化 HTTP 客户端
//        $http = new Client();

        // 初始化配置信息
        $api = 'http://121.40.155.95:8090/agent/api/uploadToCount.html';
        $appid = config('services.words_count.appid');
        $key = config('services.words_count.key');
        $sign = md5($appid . $key);
        // 构建请求参数
        $query = [
            "productid" => 2,
            "title" => $title,
            "author" => $author,
            "username" => $appid,
            "sign" => $sign,
            "orderId" => str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            "file" => $file
        ];
        // 发送 HTTP Get 请求
        $response = Http::post($api, $query);
        $result = json_decode($response->getBody(), true);
        dd($result);
    }
}
