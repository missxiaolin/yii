<?php
namespace backend\src\interfaces;

use common\src\foundation\domain\interfaces\Repository;

interface AuthItemChildInterface extends Repository
{

    /**
     * 添加权限
     * @param $children
     * @param $name
     * @return mixed
     */
    public function addChild($children, $name);

}