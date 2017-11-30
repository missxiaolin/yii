<?php
// https://packalyst.com/packages/package/cyneek/yii2-routes
use cyneek\yii2\routes\components\Route;

// 是否登录 过滤器
Route::filter('auth', [
    'class' => \common\components\Filter\AppAuth::className(),
]);

// 跨域
Route::filter('cors', [
    'class' => \yii\filters\Cors::className(),
    'cors' => [
        'Origin' => ['*'],
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Credentials' => true,
        'Access-Control-Allow-Headers' => '*',
        'Access-Control-Request-Metshod' => ['GET', 'HEAD', 'OPTIONS', 'POST'],
    ],
]);


// 路由组
Route::group(['prefix' => 'v1', 'filter' => 'auth'], function () {
    // 子路由
    Route::any('user/index', 'v1/user/index');

    Route::any('shop/list', 'v1/shop/list');
});

Route::group(['prefix' => 'v1', 'filter' => 'cors'], function () {
    // 子路由
    Route::any('rpc/index', 'v1/rpc/index');
    Route::any('user/login', 'v1/user/login');
});



// 基本路由
//Route::get('user', 'user/index');
//Route::post('user/(:any)', 'user/load/$1');
//Route::put('user/(:any),      'user / update / $1');
//Route::delete('user / (:any)',  'user / delete / $1');
//Route::head('user',           'user / index');
//Route::patch('user / (:any),    'user/update/$1');
//Route::any('user', 'user/index');

// 多个过滤器
//Route::any('user/{id}', 'user/load', ['before' => ['logged_in', 'check_params']]);
//Route::any('user/{id}', 'user/load', ['filter' => 'logged_in|check_params']);