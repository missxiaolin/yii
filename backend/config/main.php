<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    //开启中文
    'language' => 'zh-CN',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
//            'itemTable' => '{{%auth_item}}', //认证项表名称
//            'itemChildTable' => '{{%auth_item_child}}', //认证项父子关系
//            'assignmentTable' => '{{%auth_assignment}}', //认证项赋权关系
//            'ruleTable' => '{{%auth_rule}}',
            'defaultRoles' => ['guest'],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => 'backend\src\models\AdminModel',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity_backend', 'httpOnly' => true],
            'loginUrl' => ['site/login'], //要是数组
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            // this is the name of the session cookie used for login on the backend
//            'name' => 'advanced-backend',
            'redis' => [
                'hostname' => '127.0.0.1',
                'port' => 6379,
                'database' => 0,
                'password' => 'xiaolin',
            ],
            'keyPrefix' => '_identity_backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => "@runtime/logs/" . date('Y-m') . '/' . date('d') . '/' . date('H') . "-backend.log",
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'logFile' => "@runtime/logs/" . date('Y-m') . '/' . date('d') . '/' . date('H') . "-backend-info.log",
                    'categories' => ['myinfo'],
                    'logVars' => []
                ],
                [
                 'class' => 'yii\log\EmailTarget',
                 'mailer' =>'mailer',
                 'levels' => ['error', 'warning'],
                 'message' => [
                     'from' => ['17135501105@163.com'],
                     'to' => ['462441355@qq.com'],
                     'subject' => '错误日志',
                 ],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require(__DIR__ . '/routes.php'),
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //这里是允许访问的action
            //controller/action
            'site/*',
            'api/user/user/login',
            'debug/default/toolbar',
//            '*',
        ],
    ],
    'params' => $params,
];
