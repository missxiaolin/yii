<?php
namespace frontend\controllers;

use Yii;

class LiveController extends BaseController
{
    public function actionIndex()
    {
        return $this->view('index');
    }

    public function actionWatcher()
    {
//        $this->file_css = 'css/live/video-js';
        $this->file_js = 'pages/live/watcher';
        return $this->view('watcher');
    }
}