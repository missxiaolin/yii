<?php
namespace backend\src\repository;

use backend\src\entity\RoleEntity;
use backend\src\interfaces\RoleInterface;
use Carbon\Carbon;
use common\src\foundation\domain\Repository;
use Yii;

class RoleRepository extends Repository implements RoleInterface
{
    /**
     * @param RoleEntity $role_entity
     */
    protected function store($role_entity)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->createRole(null);
        $role->name = $role_entity->name;
        $role->description = $role_entity->description;
        $role->createdAt = Carbon::now();
        $role->updatedAt = Carbon::now();
        $auth->add($role);
    }

    protected function reconstitute($id, $params = [])
    {
        // TODO: Implement reconstitute() method.
    }

}