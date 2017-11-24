<?php

namespace common\src\app\support\interfaces;

use common\src\foundation\domain\interfaces\Repository;

interface ShopsInterface extends Repository
{

    /**
     * @param $param
     * @return mixed
     */
    public function getList($param);

}