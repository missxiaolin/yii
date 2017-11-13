<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'event' => [
            'class' => 'common\src\foundation\domain\Event',
        ],
        'yar' => [
            'class' => 'common\components\Rpc\YarApi',
        ],
        'queue' => [
            'class' => \yii\queue\redis\Queue::class,
            'as log' => \yii\queue\LogBehavior::class,
        ],
    ],
];
