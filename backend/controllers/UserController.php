<?php
namespace backend\controllers;
use backend\src\service\AdminService;


/**
 * Site controller
 */
class UserController extends BaseController
{
    /**
     * 用户列表
     */
    public function actionIndex()
    {
        $data = [];
        $admin_service = new AdminService();
        list($models,$pages) = $admin_service->getList();
        $data['models'] = $models;
        $data['pages'] = $pages;
        return $this->view('index', $data);
    }
}