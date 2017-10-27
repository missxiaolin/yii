<?php
namespace backend\controllers;

use Yii;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionLogin()
    {
        return $this->view('login');
    }


}
