<?php
namespace backend\src\interfaces;

use common\src\foundation\domain\interfaces\Repository;

interface RoleInterface extends Repository
{
    /**
     * 获取角色列表
     * @return mixed
     */
    public function getList();

    /**
     * 获取角色
     * @param $roles
     * @param $parent
     * @return mixed
     */
    public function getOptions($roles, $parent);

    /**
     * @param $name
     * @return mixed
     */
    public function getChildrenByName($name);

}