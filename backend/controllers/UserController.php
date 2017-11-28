<?php
namespace backend\controllers;

use backend\src\service\AdminService;
use backend\src\service\RoleService;
use Carbon\Carbon;
use Yii;


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
        list($models, $pages) = $admin_service->getList();
        $data['models'] = $models;
        $data['pages'] = $pages;
        return $this->view('index', $data);
    }

    /**
     * 分配角色
     * @param $id
     * @return mixed
     */
    public function actionAssign($id)
    {
//        dump(Carbon::now()->toDateTimeString);

        $data = [];
        $admin_service = new AdminService();
        $role_service = new RoleService();

        $admin_model = $admin_service->getUserId($id);

        $auth = Yii::$app->authManager;


        $roles = $role_service->getOptions($auth->getRoles(), null);
        $permissions = $role_service->getOptions($auth->getPermissions(), null);
        $children = $role_service->getChildrenByUser($admin_model->id);

        $data = [
            'roles' => $roles,
            'permissions' => $permissions,
            'children' => $children,
            'admin_model' => $admin_model,
        ];
        return $this->view('assign', $data);
    }
}