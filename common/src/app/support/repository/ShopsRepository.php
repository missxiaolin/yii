<?php

namespace common\src\app\support\repository;

use common\src\app\support\interfaces\ShopsInterface;
use common\src\app\support\models\ShopsModel;
use common\src\foundation\domain\Repository;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

class ShopsRepository extends Repository implements ShopsInterface
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

    /**
     * 获取门店列表
     * @param $params
     * @return array
     */
    public function getList($params)
    {
        $data = [];
        $page = ArrayHelper::getValue($params, 'page', 1);
        $per_page = ArrayHelper::getValue($params, 'per_page', 20);

        $query = ShopsModel::find();
        $pageNum = ($page - 1) * $per_page;
        $pagers = new Pagination(['totalCount' => $query->count(), 'pageSize' => $per_page]);
        $models = $query->offset($pageNum)->limit($per_page)->all();

        $data['item'] = $models;
        $data['totalCount'] = $pagers->totalCount;

        return $data;
    }
}