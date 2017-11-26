<?php
namespace backend\controllers;

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
        return $this->view('index');
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
