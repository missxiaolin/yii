<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'class' => 'api\modules\v1\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-api',
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => 'api\modules\v1\src\support\service\UserService',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity_api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-api',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => "@runtime/logs/" . date('Y-m') . '/' . date('d') . '/' . date('H') . "-api.log",
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                \Yii::$app->response->headers->set('Access-Control-Allow-Origin', '*');
                \Yii::$app->response->headers->set('Access-Control-Allow-Credentials', 'true');
                \Yii::$app->response->headers->set('Access-Control-Allow-Headers', 'origin, x-requested-with, content-type');
                \Yii::$app->response->headers->set('Access-Control-Allow-Methods', 'PUT, GET, POST, DELETE, OPTIONS');
                $response = $event->sender;
                $response->format = yii\web\Response::FORMAT_JSON;
            },
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => require(__DIR__ . '/routes.php'),
        ],
    ],
    'params' => $params,
];
