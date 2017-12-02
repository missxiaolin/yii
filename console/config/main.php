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
        'sentry' => [
            'class' => 'mito\sentry\Component',
            'dsn' => 'https://98d91bb5df92466d9c4f00661f37c561:f692d4fd92974f75a8962dfc0e7a9437@sentry.io/253662', // private DSN
//            'publicDsn' => 'https://98d91bb5df92466d9c4f00661f37c561@sentry.io/253662', // js log
            'environment' => 'staging', // if not set, the default is `production`
            'jsNotifier' => true, // to collect JS errors. Default value is `false`
            'jsOptions' => [ // raven-js config parameter
                'whitelistUrls' => [ // collect JS errors from these urls
//                    'http://staging.my-product.com',
//                    'https://my-product.com',
                ],
            ],
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'mito\sentry\Target',
                    'levels' => ['error', 'warning'],
                    'except' => [
                        'yii\web\HttpException:404',
                    ],
                ]
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
        'elasticsearch' => [
            'class' => 'yii\elasticsearch\Connection',
            'nodes' => [
                ['http_address' => '127.0.0.1:32771'],
                // configure more hosts if you have a cluster
            ],
        ],
    ],
    'params' => $params,
];
