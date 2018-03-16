<?php

namespace common\src\app\support\repository;

use common\src\app\support\interfaces\DistrictsInterface;
use common\src\foundation\domain\Repository;

class DistrictsRepository extends Repository implements DistrictsInterface
{
    /**
     * @param \common\src\foundation\domain\Entity $entity
     */
    public function store($entity)
    {
        // TODO: Implement store() method.
    }

    /**
     * @param mixed $id
     * @param array $params
     */
    public function reconstitute($id, $params = [])
    {
        // TODO: Implement reconstitute() method.
    }
}