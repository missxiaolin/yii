<?php
namespace backend\src\repository;

use backend\src\entity\RoleEntity;
use backend\src\interfaces\RoleInterface;
use backend\src\models\AuthItemModel;
use Carbon\Carbon;
use common\src\foundation\domain\Repository;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use \yii\db\Query;
use Yii;

class RoleRepository extends Repository implements RoleInterface
{
    /**
     * @param RoleEntity $role_entity
     */
    protected function store($role_entity)
    {
        $auth = Yii::$app->authManager;

        $model = new AuthItemModel();

        $model->updateAttributes(
            [
                'name' => $role_entity->name,
                'description' => $role_entity->description,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        $model->save();
    }

    protected function reconstitute($id, $params = [])
    {
        // TODO: Implement reconstitute() method.
    }

    /**
     * 获取角色列表
     * @return array
     */
    public function getList()
    {
        $query = AuthItemModel::find();
        $query->where('type = 1')->orderBy('created_at desc');
        $pagers = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10]);
        $models = $query->offset($pagers->offset)->limit($pagers->limit)->all();

        return [$models, $pagers];
    }

    /**
     * @param $roles
     * @param $parent
     * @return array
     */
    public function getOptions($roles, $parent)
    {
        $data = [];
        foreach ($roles as $obj) {
            if (!empty($parent) && $parent->name != $obj->name && Yii::$app->authManager->canAddChild($parent, $obj)) {
                $data[$obj->name] = $obj->description;
            }
            if (is_null($parent)) {
                $data[$obj->name] = $obj->description;
            }
        }
        return $data;
    }

}