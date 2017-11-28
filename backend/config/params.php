<?php
return [
    'adminEmail' => 'admin@example.com',
    'leftNav' => [
        [
            'presentation' => '小林js',
            'sidebar_trans' => [
                [
                    'icon' => '&#xe600',
                    'name' => '日期与时间',
                    'route' => 'js/data',
                ],
                [
                    'icon' => '&#xe600',
                    'name' => 'cookie使用',
                    'route' => 'js/cookie',
                ],
                [
                    'icon' => '&#xe600',
                    'name' => '模块框',
                    'route' => 'js/modal',
                ],
                [
                    'icon' => '&#xe600',
                    'name' => '消息框',
                    'route' => 'js/message',
                ],
            ],
        ],
        [
            'presentation' => '权限管理',
            'sidebar_trans' => [
                [
                    'icon' => '&#xe602',
                    'name' => '角色管理',
                    'route' => 'role/index',
                ],
                [
                    'icon' => '&#xe666',
                    'name' => '用户管理',
                    'route' => 'user/index',
                ],
            ],
        ],
    ],
];
