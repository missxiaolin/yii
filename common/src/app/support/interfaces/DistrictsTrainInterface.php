<?php

namespace common\src\app\support\interfaces;

use common\src\foundation\domain\interfaces\Repository;

interface DistrictsTrainInterface extends Repository
{
    /**
     * @param $id
     * @param $limit
     * @return mixed
     */
    public function findById($id, $limit);

    /**
     * @param $lat
     * @param $lon
     * @param $oid
     * @return mixed
     */
    public function add($lat, $lon, $oid);
}