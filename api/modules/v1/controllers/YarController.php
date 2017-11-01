<?php
namespace api\modules\v1\controllers;

use Yii;

class YarController extends BaseController
{
    protected $except = ['yar', 'all'];

    /**
     * RPC 调试
     */
    public function actionYar()
    {
        $data = Yii::$app->yar->api('test/test', 'Hello');
        dump($data);
    }

    /**
     * RPC all调试
     */
    public function actionAll()
    {
        $id = Yii::$app->yar->all('test/test', 'All', [1]);
        Yii::$app->yar->loop();
        dump($id);
    }
}