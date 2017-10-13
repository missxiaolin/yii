<?php

namespace api\modules\v1\src\support\repository;

use api\modules\v1\src\support\interfaces\UserInterface;
use api\modules\v1\src\support\Model\UserModel;
use common\src\foundation\domain\Repository;

class UserRepository extends Repository implements UserInterface
{

    /**
     * @param \common\src\foundation\domain\Entity $entity
     */
    protected function store($entity)
    {
        // TODO: Implement store() method.
    }

    /**
     * @param mixed $id
     * @param array $params
     */
    protected function reconstitute($id, $params = [])
    {
        // TODO: Implement reconstitute() method.
    }

    public function getToken($token)
    {
        return UserModel::find()->where(['token' => $token])->one();
    }

}