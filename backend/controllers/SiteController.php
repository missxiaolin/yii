<?php
namespace backend\controllers;

use Yii;

/**
 * Site controller
 */
class SiteController extends BaseController
{

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


}
