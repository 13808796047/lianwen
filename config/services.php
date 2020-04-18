<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    //百度翻译
    "baidu_translate_one" => [
        "appid" => env('BAIDU_TRANSLATE_APPID_ONE'),
        "key" => env("BAIDU_TRANSLATE_KEY_ONE"),
    ],
    "baidu_translate_two" => [
        "appid" => env('BAIDU_TRANSLATE_APPID_TWO'),
        "key" => env("BAIDU_TRANSLATE_KEY_TWO"),
    ],
    "baidu_translate_three" => [
        "appid" => env('BAIDU_TRANSLATE_APPID_THREE'),
        "key" => env("BAIDU_TRANSLATE_KEY_THREE"),
    ],
    "baidu_translate_four" => [
        "appid" => env('BAIDU_TRANSLATE_APPID_FOUR'),
        "key" => env("BAIDU_TRANSLATE_KEY_FOUR"),
    ],
    //微信登录
    'dev_lianwen_com' => [
        'wechat' => [
            'client_id' => 'wxdaab22b871fc3982',
            'client_secret' => '6680c8ec8bd33997d3f709b889f36d17',
            'redirect' => 'https://dev.lianwen.com/oauth/wechat/callback',
        ]
    ],
    'wanfang_lianwen_com' => [
        'wechat' => [
            'client_id' => 'wxdf838be09e065046',
            'client_secret' => 'ab940621f175f079285d88000af1d40c',
            'redirect' => 'https://wanfang.lianwen.com/oauth/wechat/callback',
        ]
    ],
    //获取字数
    'words_count' => [
        'appid' => env('WORDSCOUNT_APPID'),
        'key' => env('WORDSCOUNT_KEY')
    ],
    //order.lianwen.com接口
    'lianwne_api' => [
        'appid' => env('LIANWEN_APPID'),
        'public_key' => '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDOBFQY/e4rOhVMMMET8WlgKVr/
fvaX3UxKMjYhSgD/RVS6a2pbfbLzNRaWO+QW04ABEEBu+q96zuzl5dnYNxtNUYfp
CBoFgF6ISuWjCVmOdWGS3pIRrkHvYWQF/sjnxukU63uzXPEipjelnYTGRbQgBiWI
S219oi5cFhQG8bDSKwIDAQAB
-----END PUBLIC KEY-----
',
        'app_key' => env('LIANWEN_APPKEY'),
        'server_url' => env('LIANWEN_SERVER_URL')
    ]
];
