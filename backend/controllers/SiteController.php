<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    protected $actions = ['index', 'error'];

    protected $except = ['login', 'logout','log'];

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [//错误提示
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * 首页
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->view('index');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        return $this->view('login');
    }

    /**
     * 退出登录
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(Url::toRoute('site/login', true));
    }

    public function actionError()
    {
        return $this->view('error');
    }

    /**
     * 日志测试
     */
    public function actionLog()
    {
        // 出现error错误邮件发送测试
        Yii::error('sssss');

        // 记录错误日志测试
        Yii::info('sssss', 'myinfo');
        return $this->view('error-info');
    }

}
