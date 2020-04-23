<?php


namespace App\Handlers;


use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use mysql_xdevapi\Exception;

class OrderApiHandler
{
    // 初始化配置信息
    private $api;
    private $appid;
    private $key;
    private $publicKey;
    private $http;
    private $token;

    public function __construct()
    {
        // 实例化 HTTP 客户端
        $this->http = new Client();
        $this->api = config('services.lianwne_api.server_url');
        $this->appid = config('services.lianwne_api.appid');
        $this->key = config('services.lianwne_api.app_key');
        $this->publicKey = config('services.lianwne_api.public_key');
        $this->token = $this->getRequestHeader();
    }

//生成api请求的header信息
    public function getRequestHeader()
    {
        openssl_public_encrypt(
            json_encode(
                ["appId" => intval($this->appid),
                    "appKey" => $this->key,
                    "expireAt" => time() + 600,
                ]),

            $token,
            $this->publicKey
        );
        return base64_encode($token);
    }

    public function fileUpload($order)
    {
        // 构建请求参数
        $query = [
            'multipart' => [
                [
                    'name' => 'file',        //文件字段名
                    'contents' => fopen($order->paper_path, 'r') //文件資源
                ],
            ],
        ];
        $response = $this->http->post($this->api . 'file/upload', $query);

        return json_decode($response->getbody()->getContents());
    }

    public function createOrder($order, $file)
    {
        $data = [
            'cid' => $order->category->cid, //文件資源
            'title' => $order->title,
            'postDate' => '',
            'author' => $order->writer,
            'mobile' => '15050505050',
            'contentType' => 2,
            'content' => '12321321321321',
            'contentFile' => $file->data->path,
            'source' => 2,
        ];
        switch ($order->category->cid) {
            case 8:
                $body = Arr::add($data, 'endDate', $order->endDate);
                break;
            case 23:
                $body = Arr::add($data, 'publishdate', $order->publishdate);
                break;
            default:
                $body = $data;
        }
        // 构建请求参数
        $option = [
            'headers' => [
                'Token' => $this->token
            ],
            'body' => json_encode($body),
        ];
        $response = $this->http->post($this->api . 'order/create', $option);

        return json_decode($response->getbody()->getContents());
    }

    public function startCheck($id)
    {
        // 构建请求参数
        $option = [
            'headers' => [
                'Token' => $this->token
            ],
        ];
        $response = $this->http->put($this->api . 'order/start-check/' . $id, $option);
        return json_decode($response->getbody()->getContents());
    }

    public function getOrder($id)
    {
        // 构建请求参数
        $option = [
            'headers' => [
                'Token' => $this->token
            ],
        ];
        $response = $this->http->get($this->api . 'order/' . $id, $option);

        return json_decode($response->getbody()->getContents());
    }

    public function downloadReport($id)
    {
        // 构建请求参数
        $option = [
            'headers' => [
                'Token' => $this->token
            ],
        ];
        $response = $this->http->get($this->api . 'order/download-report/' . $id, $option);

        return $response->getbody()->getContents();
//        return file_put_contents(public_path().'/test.docx',$response->getbody()->getContents());
    }

    public function extractReportDetail($id)
    {
        // 构建请求参数
        $option = [
            'headers' => [
                'Token' => $this->token
            ],
        ];
        try {
            $response = $this->http->get($this->api . 'order/extract-report-detail/' . $id, $option);
            return json_decode($response->getbody()->getContents());
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function extractReportPdf($id)
    {
        // 构建请求参数
        $option = [
            'headers' => [
                'Token' => $this->token
            ],
        ];
        $response = $this->http->get($this->api . 'order/extract-report-pdf/' . $id, $option);
        return json_decode($response->getbody()->getContents());
//        try {
//
//        } catch (\Exception $e) {
//
//        }
    }
}
