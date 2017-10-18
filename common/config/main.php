<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'event' => [
            'class' => 'common\src\foundation\domain\Event'
        ]
    ],
];
