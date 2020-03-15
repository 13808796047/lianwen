<?php

return [
    'alipay' => [
        'app_id' => env('APP_ID'),
        'public_key' => env('PUBLIC_KEY'),
        'private_key' => env('PRIVATE_KEY'),
        'notify_url' => env('NOTIFY_URL'),
        'log' => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id' => '',
        'mch_id' => '',
        'key' => '',
        'cert_client' => '',
        'cert_key' => '',
        'log' => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];
