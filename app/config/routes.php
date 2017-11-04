<?php
use cyneek\yii2\routes\components\Route;

// 是否登录
Route::filter('auth', [
    'class' => \common\components\Filter\AppAuth::className(),
]);

Route::group(['prefix' => 'v1', 'filter' => 'auth'], function () {
    Route::any('user/index', 'v1/user/index');
});
