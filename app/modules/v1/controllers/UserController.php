<?php
namespace api\modules\v1\controllers;

use Yii;

class UserController extends BaseController
{
    protected $except = ['index', 'register'];

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