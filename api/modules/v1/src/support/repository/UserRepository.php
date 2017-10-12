<?php

namespace api\modules\v1\src\support\repository;

use api\modules\v1\src\support\interfaces\UserInterface;
use api\modules\v1\src\support\Model\UserModel;

class UserRepository implements UserInterface
{

    public function getToken($token)
    {
        return UserModel::find()->where(['token' => $token])->one();
    }

}