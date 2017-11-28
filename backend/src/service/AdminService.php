<?php
namespace backend\src\service;


use backend\src\repository\AdminRepository;

class AdminService
{
    /**
     * @param $username
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getUser($username)
    {
        $user_repository = new AdminRepository();
        $user_model = $user_repository->getUser($username);
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
        $user_repository = new AdminRepository();
        return $user_repository->validatePassword($db_password, $auth_key, $password);
    }

    /**
     * 获取管理员列表
     * @return array
     */
    public function getList()
    {
        $user_repository = new AdminRepository();
        return $user_repository->getList();
    }

}