<?php

namespace common\src\app\support\service;


use common\src\app\support\repository\UserRepository;

class UserService
{
    /**
     * @param $email
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getEmail($email)
    {
        $user_repository = new UserRepository();
        $user_model = $user_repository->getEmail($email);
        return $user_model;

    }

    /**
     * 验证密码
     * @param $db_password
     * @param $auth_key
     * @param $password
     * @return string
     */
    public function validatePassword($db_password, $auth_key, $password)
    {
        $user_repository = new UserRepository();
        return $user_repository->validatePassword($db_password, $auth_key, $password);
    }

}