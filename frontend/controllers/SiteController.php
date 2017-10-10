<?php
namespace frontend\controllers;

use Yii;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->title = '首页';
        $this->file_css = 'css/index/index';
        $this->file_js = 'pages/index/index';
        return $this->view('index');
    }

}
