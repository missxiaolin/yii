<?php
namespace backend\src\service;


use backend\src\repository\RoleRepository;

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
}