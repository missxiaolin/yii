<?php
namespace app\modules\v1\controllers;

use Yii;

class UserController extends BaseController
{
    /**
     * 首页（测试用）
     * @return array
     */
    public function actionIndex()
    {
        $data = [];
        return $this->apiResponse($data);
    }
}