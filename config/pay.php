<?php

return [
    'alipay' => [
        'app_id' => '2016091300504208',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAohekZzCsndUAp1Zx2EPwJcftwkFFKpdNPs+eNHMNb3MNoFtuIIraydZ+vUQJw6hxE6VvmSDBD9zVFkWcgJY7c9AYONiWczGjXK2SnHxUnSssLxy98JZmJW5k79u2EzGk6etP4Yhr4aKOSTBTbmRbgeAPCcVYC0WXvO/Cvnnjew3GnzmWt4WE4S1+2SLi/1yYlC7rYA8220Gra/6yTibtgHJLckGxrregjNM4MVDc73YMe8oy/VX4WzHs3JWACBJ34GjW5ozgI/JVpDaKyYqWLSEKxJ6oiOifTDhLoYNjY4KZUpe1pYuHVbmNcVSz4rWVSWlhqrCCAqQ9PeE+S1VW4QIDAQAB',
        'private_key' => 'MIIEowIBAAKCAQEAohekZzCsndUAp1Zx2EPwJcftwkFFKpdNPs+eNHMNb3MNoFtuIIraydZ+vUQJw6hxE6VvmSDBD9zVFkWcgJY7c9AYONiWczGjXK2SnHxUnSssLxy98JZmJW5k79u2EzGk6etP4Yhr4aKOSTBTbmRbgeAPCcVYC0WXvO/Cvnnjew3GnzmWt4WE4S1+2SLi/1yYlC7rYA8220Gra/6yTibtgHJLckGxrregjNM4MVDc73YMe8oy/VX4WzHs3JWACBJ34GjW5ozgI/JVpDaKyYqWLSEKxJ6oiOifTDhLoYNjY4KZUpe1pYuHVbmNcVSz4rWVSWlhqrCCAqQ9PeE+S1VW4QIDAQABAoIBAHXozs3FiXuSa1ROvKe9294PzjNFeYPe5fDv5DxxCO/ueJYSjEyd1UOHhVA2QwgR6peI+2IfgnEAif0WjB65qeu4DzaizuZi0FvlY0Xz5zUhJ5XpyX1OWmWWJVSZtZvGvBjw9H2x2BAdSHWS8s3VsP8LtsS7yi0A5b0ph7c5QTHMCxRj8L7q6ZBCoPtS1XDyXe3zRdmHJE+xr2v4U0r9ksHlj74k/wVfPOBG7ktW9VZBMk7gRLOS0VwXbwYd817oo2U17v2uG+rQ4zWaa+oXfknottCPj7Xf5+0X4WC4Sai5Ur6HxulOsMctZy9dZaCeAdNXOkS83nL4i4C2Y46DB/UCgYEA65bNecYtCxlX4FRe5csqv69u00S7Yld3qPvgLAtQd+IiGIY21ZBTQfSsfE5PZwQqxbXNs2itb3n+/j/1raiid83F7s3W+/PZWkEJRekjXUoadHtjy+TGtNp5CrPpLQNiXJQ7Rgn3/XZnm9SN3YDpivz1UxgL0BOI8hxPzL+++KsCgYEAsCK8G6N9MU6qqJkj2UUDqqgpF9xdgJFagKpBW5GM+TdnCgKec3qC90j+kbtAOHbzs2rJM6rDdFW6LDvoKaPbBWUrkeU1BVpWoOQVacEgavbpF3J5Z2GeDZ9l1M05PYy1Ah76qz18noq3UgvuS61Q7VpZtBcFkpy17av2UkK7BqMCgYEAlw4RX6Qu22/7hW3zjvnOxitRLwth7rNQmTwux27VwJhw7jKYVCT/DUo5klaP2Oi2GCDy7LcQhWq+kf0mpJt82L5KzEyVLOV0lscekAHlV/qcrdUz7tcYhXuTosYqm18RIXU18DmSFaVm12bZM45lsGVzUz0WzerIoxx+GjVT2JMCgYBSicRqkz9cdsfEQBcrforMUwcGtm5ejD7D4oTEGz3bn1m6uCV2aeerZ9pbgksC6sMixZzJiHEVOAMJLX2K3c0KBzHWqXkiLAZCWP+r0iOV3GS4Zx17E6SUL6jxgsYbEK/V8Zx32FVomgpz+UFO10YAJAG7QbqLzMH4QUgpnjm0TwKBgH5BMe6At7dEPnd2iD5aJCjcgAQ9Q/ojcQ6Kyh3OO+eap9om7sMXQ8Zah4b3xZH3h+G7yTgDtk8rgToC6IL1GzJ/LkZ/VFLY2xF2+ZosCDVcyCFmcGZI+WsEfY7YQISroYhr4lUXkrIOGJ72RE8H6D0NJxHsw6bmE0oSaZjrHgTg',
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
