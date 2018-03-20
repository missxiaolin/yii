<?php

namespace common\src\app\support\interfaces;

use common\src\foundation\domain\interfaces\Repository;

interface DistrictsInterface extends Repository
{
    /**
     * @param $level
     * @return mixed
     */
    public function findByLevel($level);

    /**
     * @param $level
     * @param $id
     * @param $limit
     * @return mixed
     */
    public function findByLevelAndId($level, $id, $limit);
}