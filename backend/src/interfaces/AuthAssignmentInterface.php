<?php
namespace backend\src\interfaces;

use common\src\foundation\domain\interfaces\Repository;

interface AuthAssignmentInterface extends Repository
{

    /**
     * 添加角色
     * @param $admin_id
     * @param $children
     * @return mixed
     */
    public function grant($admin_id, $children);

}