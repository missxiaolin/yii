<?php
namespace backend\src\service;


use backend\src\repository\RoleRepository;
use Yii;

class RoleService
{
    /**
     * 获取角色列表
     * @return array
     */
    public function getList()
    {
        $role_repository = new RoleRepository();
        return $role_repository->getList();
    }

    /**
     * 获取role
     * @param $roles
     * @param $parent
     * @return array
     */
    public function getOptions($roles, $parent)
    {
        $role_repository = new RoleRepository();
        return $role_repository->getOptions($roles, $parent);
    }

    /**
     * 获取已有的权限
     * @param $name
     * @return array
     */
    public static function getChildrenByName($name)
    {
        $data = [];
        return $data;
    }
}