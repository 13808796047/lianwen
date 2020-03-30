<?php

return [
    'alipay' => [
        'app_id' => '2018050102616528',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAg4cYPHEN6jhjekt+HhSFTOVkTu2ubiT/r2gCZV7U7Kkxei6TrSYsKgtaw8IkP3CnUbWbYChEzPlotnKBXpUJY/R3yWpyHLpEMBucldfulfGPRElOkanHcpucMBKiWKjEH9Y6bLsurwGwV0Q1EF3zUJelWGYeKwpNh4mLgR8XEBNBzmzSF8emE+0i2sZxZp6p92AP8k3HrI9DICM0+2HmLkvTw6u9pejjL4mPsNDrHSfEJUBeaqTKOsotyJiLICNKvr9jbL3QEAuyknguIbS3HGDuDIOnxAAqzz9INLSyhRPzSwhfymH36qxJofhjZFeO4pdQWjrqzZEswZ5tx7NFswIDAQAB',
        'private_key' => 'MIIEpAIBAAKCAQEAil0ct0gZy1ey5BDeoj/JoUaRYdc+UKoZ0hF81LbVBPCmunSaF+TKFzSMzcmlfAVRSFkHCKD26xTcb1RDdAPxlW4/n7yGgNyksi7EPlDhiV1FAZK2/boKiUWuw5jlSktv2kshYMmfokgT8hFe6xwwoNqAUX8B4Uiis/WbwF1gXB1NSDyb1EMk+hqueg4cIlBmK699eBLBnxEyv1Xf7RBka4/f/iVYaMNXJcxhQfSstF85Bf37A404TINO+V7V5tdPoDAD3TM+SKiT/SK1ZWiTa8ON6220wa9HX9563zy4FxMBZnbyjPkQc+AhqgX/D0tcW0FbQlXt7ZJF3FDxc1eAPwIDAQABAoIBAAbZ12sn0cckv4HVaACmoegvY1Fx4+8AjSi+nuy1ZNTKyaaf0WVveaYufu5NlrkOVlj7t4Jw3ekD7mpAxNpAu7yHafUR06Mbybfc4vCm9pPjn2AVkKP9izoCzkV3E5tbIt2vLKbrNNFHOl2ZCJchnTLJvuLKJCCwhQXeGmkq9nN5GURgj0xAjMHofXB38OZ/bLkXFtZu3jLD8CfpwdCJsY8tQOwl4lqmV8A8vOvAWaqAkSocsNG64KJA2JA6jvmWDhrP2lLb90BGAGlkoJeSkrpQ2n4pBOhUIBsMJVo2VvwO7lbVMWi4ULQNx/NdqehCO15IE8YJf/DcKXJerAAvlpECgYEAyfFL8jjwXnvTLRQTHBa9SGLzrHz4o0GmpJ+LGCTsj125XlG/V11z0/+BdkCSqKUcdas3Kxuuz3t33MPbiFHpldd09h0MCvC0hWXN0B4N2qIXmvKDu78mACEPlzYbntPZ+c0Mx2e+NaTz4mUZHT6vfLyK14saHIS3fgrDIFQelLcCgYEAr2bjwAbIy4GSvVvGCRVAqIMWi9TdAeoRQdlFUajHwl4BakpGF7j5BD9rkPPfBke6YzZXL/YX0CcnyEXVaX9jnNd8j8j3TiXCTUcs+mfYIlonRSzcyukNTpGLaALF9uns3m/gU9wevHw1EBTA6yFNkIf1EgZ/RW3lP7C54zL6OLkCgYEAsvljCMsD5YkysNoA0b0phpUER1P+/Jm7ul0X5o8bBTjYh8pFnYVamYHyWD6EfGjRH0xeOZtwQ7y2j3caAugt8DojE9jMiomoRC3kyVVJjAJqj03uCKAxap3idm5i7lHt9uGPOM8uGdcWuwhEyNF8sD1dhAhpXOsWwOOC6g0DiWMCgYEAkpPJ+ZvxytcCOInr6YVAHlJF0h7VfhcLytp1qjMAlDYYuqlM/+ANAPa6vkx98PKaGPS9UZA3ADToct2g5WOWa+hL6KCJwl2djRTQyoVjQfnS3WULMeolu6W3OPkwVBHSZ2RYs9u8N8kYUtL1EMko14I2U5ToYK3gqSPXg70DC8kCgYBQ6lIpMIaobOGTrAUO16SlKvUe2nh8LTX5x74EaFpPVerwBSp7EodPm2xKqRR3gF89dqxoCHfUQeSoOiJ9IJSKjKl27a4WcSoKLoouSGjnGPSXnA2O4LFoD8wuZTRsquG9R3PJuuea4c0qt2xPlmcjXf7pTjruLXQ8yz7ZBjKTGg==',
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
    'baidu_pay' => [
        'app_id' => '28990',
        'rsaPubKeyStr' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCGgALBxBbJ6+gU9+zqkkTm37M13rG56wqh5NsPFCbxKPYYuPbPIsXzGisVYNHfPFwMaTOaEgsXfSQspF9B5SyBny4Nq1Jv99bOiDhC1qQrMcymzkQ892RzkxrStIB8l1z4ktKUhnOBVzUEoK9Gxly28c+n4Wmp2QiEJ0dGMReDtQIDAQAB',
        'reaPriKeyStr' => 'MIICWwIBAAKBgQCGgALBxBbJ6+gU9+zqkkTm37M13rG56wqh5NsPFCbxKPYYuPbPIsXzGisVYNHfPFwMaTOaEgsXfSQspF9B5SyBny4Nq1Jv99bOiDhC1qQrMcymzkQ892RzkxrStIB8l1z4ktKUhnOBVzUEoK9Gxly28c+n4Wmp2QiEJ0dGMReDtQIDAQABAoGACU0I48Vfng8GOYz7gS0kPqLxjaQcvjKWxaNB0sUd/EdM3WDNEH3jGnCQ0iWj3cAazXDo9JqS0ckBm2SygagLb8GOCJn6na2aarDMyjpl12IVZMkliIGLb7Gbg1dwevYTaghJbHHJcdkZijf108nqm27VZdhOa3ryHFu7G1brW3ECQQDGMSfY5AM15Mfmb8wuUHVESmIaIPXCyckbebmZHuxlJFYlF3CmYmBksCektLLhcizxthM6CEB5+HUXpmdro94nAkEArbsGW6Bg/vI8OeA+N1lCPwhR5CJH73eS6N/btUMmiKAc6OdigfcqSyAg6P8cYbsDer5CT+xh1n/xW5PRU2vUwwJAL7YrspIJl9LQsM/fJpMl99+0SDgBEfiD2oJuRMdl/19FAb7n1pY+QF8L3CHIIm/bFAFSFZlg9Dv07FGZ+hbD5wJAfmbcKmBXEkem4Ckyu0ybMYdZJdZ3Zlkmr37ouUqBR9jPD/oCJzNxNzXKHBw5RzYtQuoZD1Oan9l4/zteiwaixwJAOONDiJnYz8v9C09GXLW4K3RV/tbZARN2ZDgxksTHiqNqAl1xh2lag7g68d7KRO2BgX/1naqsfPRbWhCMovo6ZA==',
        'appKey' => 'MMUaVY',
        'dealId' => '470215513'
    ]
];
