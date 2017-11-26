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

}