<?php
namespace app\modules\v1\controllers;

use app\src\form\loginForm;
use app\src\service\AdminService;
use Yii;

class UserController extends BaseController
{
    /**
     * 首页（测试用）
     * @return array
     */
    public function actionIndex()
    {
        $data = [];
        return api_response($data);
    }

    /**
     * 登录接口
     * @return array
     */
    public function actionLogin()
    {
        $data = [];
        $param = $this->request;
        $login_from = new loginForm();
        $login_from->load($param, '');
        if ($login_from->validate()) {
            $admin_service = new AdminService();
            $model = $admin_service->setToken($param['username']);
            $data['token'] = $model->access_token;
        } else {
            return api_response([], 500, array_values($login_from->getFirstErrors())[0]);
        }
        return api_response($data);
    }
}