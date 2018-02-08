<?php
namespace frontend\controllers;

use Yii;

/**
 * Site controller
 */
class CodeController extends BaseController
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $data = [];
        $this->title = '首页';
        $this->file_css = 'css/code/index';
        $this->file_js = 'pages/code/index';
        return $this->view('index');
    }

}
