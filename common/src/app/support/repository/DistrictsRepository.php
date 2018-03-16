<?php

namespace common\src\app\support\repository;

use common\components\Common\InstanceTrait;
use common\src\app\support\interfaces\DistrictsInterface;
use common\src\app\support\models\DistrictsModel;
use common\src\foundation\domain\Repository;

class DistrictsRepository extends Repository implements DistrictsInterface
{
    use InstanceTrait;

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

    /**
     * @param int $level
     * @param int $id
     * @param int $limit
     * @return $this
     */
    public function findByLevelAndId($level = 3, $limit = 10)
    {
        $query = DistrictsModel::find();
        $query->where(['level' => $level]);
        $model = $query->limit($limit)->all();
        return $model;
    }
}