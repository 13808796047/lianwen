<?php

return [
    'alipay' => [
        'app_id' => env('PAY_ALIYUN_APP_ID'),
        'ali_public_key' => env('PAY_ALIYUN_PUBLIC_KEY'),
        'private_key' => env('PAY_ALIYUN_PRIVATE_KEY'),
        'log' => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id' => env('WECHAT_APP_ID'),
        'mch_id' => env('WECHAT_MCH_ID'),
        'key' => env('WECHAT_KEY'),
        'cert_client' => '',
        'cert_key' => '',
        'log' => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
    'baidu_pay' => [
        'app_id' => env('BAIDU_APP_ID'),
        'rsaPubKeyStr' => env('BAIDU_PUBLIC_KEY'),
        'reaPriKeyStr' => env('BAIDU_PRIVATE_KEY'),
        'appKey' => env('BAIDU_APP_KEY'),
        'dealId' => env('BAIDU_DEALID')
    ]
];
