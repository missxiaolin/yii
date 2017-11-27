<?php
namespace backend\src\service;

use backend\src\repository\AuthItemChildRepository;
use Yii;

class AuthItemChildService
{

    /**
     * 添加权限
     * @param $children
     * @param $name
     * @return bool
     */
    public function addChild($children, $name)
    {
        $auth_item_child_repository = new AuthItemChildRepository();
        return $auth_item_child_repository->addChild($children, $name);
    }

}