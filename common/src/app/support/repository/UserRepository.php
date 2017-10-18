<?php

namespace common\src\app\support\repository;

use Carbon\Carbon;
use common\src\app\support\entity\UserEntity;
use common\src\app\support\interfaces\UserInterface;
use common\src\app\support\models\UserModel;
use common\src\foundation\domain\Repository;

class UserRepository extends Repository implements UserInterface
{
    /**
     * @param UserEntity $user_entity
     */
    protected function store($user_entity)
    {
        // TODO: Implement store() method.
        $user_model = new UserModel();
        $user_model->created_at = Carbon::now();
        $user_model->updated_at = Carbon::now();
        $user_model->updateAttributes(
            [
                'username' => $user_entity->username,
                'auth_key' => $user_entity->auth_key,
                'password' => $user_entity->password,
                'email' => $user_entity->email,
            ]
        );
        $user_model->save();
        $user_entity->setIdentity($user_model->id);
    }

    protected function reconstitute($id, $params = [])
    {
        // TODO: Implement reconstitute() method.
    }

    /**
     * @param $email
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getEmail($email)
    {
        $query = UserModel::find();
        $model = $query->where(['email' => $email])->one();
        return $model;
    }

    /**
     * 密码验证
     * @param $db_password
     * @param $auth_key
     * @param $password
     * @return string
     */
    public function validatePassword($db_password, $auth_key, $password)
    {
        $postPwd = md5(md5($password) . $auth_key);
        if ($db_password != $postPwd) {
            return false;
        }
        return true;
    }

}