<?php

namespace app\modules\v1\controllers;

use Yii;
use yii\rest\Controller;


class BaseController extends Controller
{
    public $request;

    /**
     * get post 参数
     */
    public function init()
    {
        parent::init();
        if (Yii::$app->request->isGet) $this->request = Yii::$app->request->get();
        if (Yii::$app->request->isPost) $this->request = Yii::$app->request->bodyParams;
    }

}
