<?php
namespace backend\controllers;


/**
 * Site controller
 */
class AdminController extends BaseController
{
    /**
     * 用户列表
     */
    public function actionIndex()
    {
        $data = [];
        return $this->view('index', $data);
    }
}