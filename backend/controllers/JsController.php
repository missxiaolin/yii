<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Url;

/**
 * Site controller
 */
class JsController extends BaseController
{
    /**
     * 日期组件使用
     * @return mixed
     */
    public function actionData()
    {
        return $this->view('data');
    }

    /**
     * cookie使用
     * @return mixed
     */
    public function actionCookie()
    {
        return $this->view('cookie');
    }

}