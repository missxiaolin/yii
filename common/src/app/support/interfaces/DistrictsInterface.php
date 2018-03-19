<?php

namespace common\src\app\support\interfaces;

use common\src\foundation\domain\interfaces\Repository;

interface DistrictsInterface extends Repository
{
    /**
     * @param $level
     * @return mixed
     */
    public function findByLevelAndId($level);
}