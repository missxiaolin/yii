<?php
namespace assets\controllers;

use assets\src\service\UserService;
use yii\web\Controller;

/**
 * Site controller
 */
class UserController extends Controller
{
    /**
     * 用户接口
     */
    public function actionRegister()
    {
        $service = new \Yar_Server(new UserService());
        $service->handle();
    }
}
