<?php
namespace backend\controllers;

use backend\src\service\RoleService;
use Yii;

/**
 * RoleController
 */
class RoleController extends BaseController
{
    /**
     * 角色
     * @return mixed
     */
    public function actionIndex()
    {
        $data = [];
        $role_service = new RoleService();
        list($role_models, $pagers) = $role_service->getList();
        $data['roles'] = $role_models;
        $data['pagers'] = $pagers;
        return $this->view('index', $data);
    }

    /**
     * 添加角色
     * @param $id
     * @return mixed
     */
    public function actionCreateRole($id)
    {
        $data = [];
        $data['id'] = $id;
        return $this->view('edit', $data);
    }

    /**
     * 分配权限
     * @param $name
     * @return mixed
     */
    public function actionAssignItem($name)
    {
        $data = [];
        $data['parent'] = $name;

        $auth = Yii::$app->authManager;
        $parent = $auth->getRole($name);
        $role_service = new RoleService();
        $roles = $role_service->getOptions($auth->getRoles(), $parent);
        $data['roles'] = $roles;
        $permissions = $role_service->getOptions($auth->getPermissions(), $parent);
        $data['permissions'] = $permissions;

        $children = $role_service->getChildrenByName($name);
        $data['children'] = $children;
        return $this->view('assign-item', $data);
    }

}
