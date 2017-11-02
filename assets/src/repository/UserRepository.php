<?php

namespace assets\src\repository;

use assets\src\interfaces\UserInterface;
use Carbon\Carbon;
use assets\src\entity\UserEntity;
use assets\src\models\UserModel;
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

    /**
     * @param mixed $id
     * @param array $params
     */
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