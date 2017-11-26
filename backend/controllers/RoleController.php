<?php
namespace backend\controllers;

use backend\src\service\RoleService;
use Yii;
use yii\helpers\Url;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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

}
