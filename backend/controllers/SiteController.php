<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Url;

/**
 * Site controller
 */
class SiteController extends BaseController
{

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


}
