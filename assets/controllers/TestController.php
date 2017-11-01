<?php
namespace assets\controllers;

use assets\yar\Test;
use common\components\Rpc\YarApi;
use Yii;
use yii\web\Controller;

/**
 * Site controller
 */
class TestController extends Controller
{
    public function actionTest()
    {
        $service = new \Yar_Server(new Test());
        $service->handle();
    }
}