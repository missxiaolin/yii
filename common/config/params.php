<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    /*
        |--------------------------------------------------------------------------
        | THRIFT Environment
        |--------------------------------------------------------------------------
        |
        | register          : 注册中心相关配置
        |  ├─ key           : 签名用KEY
        |  ├─ signVerify    : 是否需要验证签名
        |  ├─ open          : 是否注册到注册中心
        |  ├─ host          : 注册中心地址
        |  ├─ port          : 注册中心端口号
        |  └─ persistent    : 是否对服务列表持久化
        |
        | service: 服务相关配置
        |  ├─ listKey       : 缓存服务用的Redis Key
        |  └─
        |
        */
    'thrift' => [
        'register' => [
            'key' => 'helloworld',
            'signVerify' => true,
            'open' => false,
            'host' => '127.0.0.1',
            'port' => 11521,
            'persistent' => true,
        ],
        'service' => [
            'listKey' => 'yii:register:service:list',
        ],
    ],
];
