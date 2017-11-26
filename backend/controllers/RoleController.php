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
    protected $actions = ['index'];

    /**
     * 角色
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->view('index');
    }


}
