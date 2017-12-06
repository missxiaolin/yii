<?php
namespace frontend\controllers;

use Yii;

class LiveController extends BaseController
{
    public function actionIndex()
    {
        return $this->view('index');
    }
}