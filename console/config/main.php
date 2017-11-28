<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'queue'],
    'controllerNamespace' => 'console\controllers',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => '{{%auth_item}}', //认证项表名称
            'itemChildTable' => '{{%auth_item_child}}', //认证项父子关系
            'assignmentTable' => '{{%auth_assignment}}', //认证项赋权关系
            'ruleTable' => '{{%auth_rule}}',
            'defaultRoles' => ['guest'],
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 1,
            'password' => 'xiaolin',
        ],
        'resque' => [
            'class' => 'common\components\Yii2Resque',
        ],
    ],
    'params' => $params,
];
