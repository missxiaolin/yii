<?php
use cyneek\yii2\routes\components\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::any('user/index', 'v1/user/index');
});
