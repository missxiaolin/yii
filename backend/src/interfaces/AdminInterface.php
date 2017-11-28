<?php
namespace backend\src\interfaces;

use common\src\foundation\domain\interfaces\Repository;

interface AdminInterface extends Repository
{

    /**
     * @param $user_name
     * @return mixed
     */
    public function getUser($user_name);

    /**
     * @param $id
     * @return mixed
     */
    public function getUserId($id);

    /**
     * @param $db_password
     * @param $auth_key
     * @param $password
     * @return mixed
     */
    public function validatePassword($db_password, $auth_key, $password);

    /**
     * 获取后台用户列表
     * @return mixed
     */
    public function getList();

}