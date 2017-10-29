<?php
namespace backend\controllers;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class JsController extends BaseController
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'data',
                            'cookie',
                            'modal',
                            'message'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

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

    /**
     * 模态框
     * @return mixed
     */
    public function actionModal()
    {
        return $this->view('modal');
    }

    /**
     * 消息框
     * @return mixed
     */
    public function actionMessage()
    {
        return $this->view('message');
    }
}