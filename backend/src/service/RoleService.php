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
        $role_repository = new RoleRepository();
        return $role_repository->getChildrenByName($name);
    }

    /**
     * @param $admin_id
     * @return array
     */
    public function getChildrenByUser($admin_id)
    {
        $role_repository = new RoleRepository();
        $data = $role_repository->getChildrenByUser($admin_id, 1);
        return $data;
    }
}