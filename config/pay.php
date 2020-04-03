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
        'reaPriKeyStr' => '-----BEGIN RSA PRIVATE KEY-----
        MIICWwIBAAKBgQCDZJvuJXNUVqGON7PDj5kBdufWjBXcKBcL2aasAo39buePFbcrpBIIWE0QeEWyL6W7a+eJ103Ce6YTg3HeCsTz2n5dG1oP9/qwedUQAjlvUzpMIV8InNvZqfc9Cj5sdcHp+oXEXjz1OOb0ytXyJwTY7a9sGYL0d+fVGTDHCYZi7wIDAQABAoGAJ3OoFkOMc4BnlepHwap2SKhJSHRbg/VNpjM+BlvmAniwcpgUnbfv6i2JRi62zp/b5YCqzwqkwIacATPwlrkpFZMCeIu096urOEqE1XJtfV5R9oDo/i0yAIKMXqjV3TmR3bMoi+A1QECY2OtuvMSBGfZYY+OnvPv6DAtMJvtPRrECQQD/cOU+SzmS7a30aH/UZcXpiljgPhTRXg10BQ9AkguNfXNUfeGNo38ZuJDba1bXm3PxAKNZW8M1dzhYryyj/uP1AkEAg644AsQD5L1xzrRm3t+OGHBgFINKJjDjwCxKFKcsieH3JIFoJuO2n+iP2fs3lvB6gwovf6g2O5wJn6RPBt6A0wJAZ1K2F517+1eSjpMaacKE7HNegc36w7lkfbJyOe8ZJzFATkPg0Vb52WCTj316khm6KxjT+hgo/N5td0ncJ7W5ZQJAdcKrIoYLeVeWXKXmzXAdkmuE8TNMb4UPWIADLB8o7JIhRAtailTgsHb5lpZca2baGTBVtBNJlNuBm7wEVH9NswJAdsgK6Vu6Cgg05ovwHD1ZxFOea09NjYEvBMpLcGW9vWCfYoT34tPdmLUB/2QAb11Bj3Keyz4NB843z73e4+d67g==
        -----END RSA PRIVATE KEY-----',
        'appKey' => env('BAIDU_APP_KEY'),
        'dealId' => env('BAIDU_DEALID')
    ]
];
