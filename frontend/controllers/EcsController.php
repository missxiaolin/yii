<?php
namespace frontend\controllers;

use Yii;

/**
 * Site controller
 */
class EcsController extends BaseController
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $data = [];
        $this->title = 'ecs';
        $this->file_css = 'css/ecs/index';
        $this->file_js = 'pages/ecs/index';
        return $this->view('index');
    }

}