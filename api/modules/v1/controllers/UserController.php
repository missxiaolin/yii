<?php
namespace api\modules\v1\controllers;

use Yii;

class UserController extends BaseController
{
    protected $except = ['index'];

    /**
     * 首页
     * @return array
     */
    public function actionIndex()
    {
        $data = [];
        return $this->apiResponse($data);
    }
}