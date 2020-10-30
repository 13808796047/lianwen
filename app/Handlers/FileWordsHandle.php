<?php


namespace App\Handlers;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class FileWordsHandle
{
    protected $http;
    protected $uri;
    protected $username;
    protected $key;
    protected $productid;
    protected $sign;

    public function __construct(Client $client)
    {
        $this->http = $client;
        $this->uri = 'http://api.weipu.com/agent/api';
        $this->username = config('services.words_count.username');
        $this->key = config('services.words_count.key');
        $this->productid = 2;
    }

    public function submitCheck($file)
    {
        // 构建请求参数
        $query = [
            'multipart' => [
                [
                    'name' => 'productid',        //字段名
                    'contents' => $this->productid    //對應的值
                ],
                [
                    'name' => 'username',        //字段名
                    'contents' => $this->username    //對應的值
                ],
                [
                    'name' => 'sign',        //字段名
                    'contents' => md5($this->username . $this->productid . $this->key)     //對應的值
                ],
                [
                    'name' => 'file',        //文件字段名
                    'contents' => fopen($file, 'r') //文件資源
                ],
            ]
        ];

        $response = $this->http->post($this->uri . '/submit-check', $query);
        return json_decode($response->getbody()->getContents(), true);
    }

    public function queryParsing($orderid)
    {
        // 构建请求参数
        $query = [
            'multipart' => [
                [
                    'name' => 'username',        //字段名
                    'contents' => $this->username    //對應的值
                ],
                [
                    'name' => 'sign',        //字段名
                    'contents' => md5($this->username . $orderid . $this->key)     //對應的值
                ],
                [
                    'name' => 'orderid',        //文件字段名
                    'contents' => $orderid
                ],
            ]
        ];
        try {
            do {
                $response = $this->http->post($this->uri . '/query-parsing', $query);
                $result = json_decode($response->getbody()->getContents(), true);
            } while ($result['code'] != 0);
            return $result;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        // 开始每个请求，但是不阻塞
//        $request = new Request('POST', );
//        $promise = $this->http->postAsync($this->uri . '/query-parsing', $query)->then(function($response) {
//            return json_decode($response->getbody()->getContents(), true);
//        });
//        $promise->wait();

    }

    public function getWords($title, $author, $file)
    {
//        // 实例化 HTTP 客户端
//        $http = new Client();
//        // 初始化配置信息
//        $api = 'http://121.40.155.95:8090/agent/api/uploadToCount.html';
//        $appid = config('services.words_count.appid');
//        $key = config('services.words_count.key');
//        $sign = md5($appid . $key);
//        // 构建请求参数
//        $query = [
//            'multipart' => [
//                [
//                    'name' => 'productid',        //字段名
//                    'contents' => 2    //對應的值
//                ],
//                [
//                    'name' => 'title',        //字段名
//                    'contents' => $title    //對應的值
//                ],
//                [
//                    'name' => 'author',        //字段名
//                    'contents' => $author    //對應的值
//                ],
//                [
//                    'name' => 'username',        //字段名
//                    'contents' => 'lianwen'    //對應的值
//                ],
//                [
//                    'name' => 'sign',        //字段名
//                    'contents' => $sign     //對應的值
//                ],
//                [
//                    'name' => 'orderId',        //字段名
//                    'contents' => str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT),  //對應的值
//                ],
//                [
//                    'name' => 'file',        //文件字段名
//                    'contents' => fopen($file, 'r') //文件資源
//                ],
//            ]
//        ];
//
//        $response = $http->post($api, $query);
//        return json_decode($response->getbody()->getContents(), true);
    }
}
