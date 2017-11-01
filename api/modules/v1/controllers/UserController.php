<?php
namespace api\modules\v1\controllers;

use Yii;

class UserController extends BaseController
{
    protected $except = ['index', 'yar'];

    /**
     * 首页
     * @return array
     */
    public function actionIndex()
    {
        $data = [];
        return $this->apiResponse($data);
    }

    /**
     * RPC 调试
     */
    public function actionYar()
    {
        $data = Yii::$app->yar->api('test/test','Hello');
        dump($data);
    }
}