<?php
namespace frontend\controllers;

use Yii;

class WebSocketController extends BaseController
{

    public function actionIndex()
    {
        $this->title = 'socket-me';
        $this->file_js = 'pages/socket/index';
        return $this->view('index');
    }


    public function actionLook()
    {
        $this->title = 'socket-look';
        $this->file_js = 'pages/socket/look';
        return $this->view('look');
    }

}