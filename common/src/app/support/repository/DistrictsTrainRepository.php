<?php

namespace common\src\app\support\repository;

use common\components\Common\InstanceTrait;
use common\src\app\support\interfaces\DistrictsTrainInterface;
use common\src\app\support\models\DistrictsTrainModel;
use common\src\foundation\domain\Repository;

class DistrictsTrainRepository extends Repository implements DistrictsTrainInterface
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
     * @param int $id
     * @param int $limit
     * @return mixed
     */
    public function findById($id = 0, $limit = 100)
    {
        $query = DistrictsTrainModel::find();
        $query = $query->where(['>', 'id', $id]);
        $query = $query->limit($limit);
        $model = $query->all();
        return $model;
    }

    public function add($lat, $lon, $oid)
    {
        $model = new DistrictsTrainModel();
        $model->lon = $lon;
        $model->lat = $lat;
        $model->oid = $oid;
        try {
            return $model->save();
        } catch (\Exception $ex) {

        }
    }
}