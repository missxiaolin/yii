<?php
namespace backend\src\repository;

use backend\src\interfaces\AdminInterface;
use backend\src\models\AdminModel;
use common\src\foundation\domain\Repository;

class AdminRepository extends Repository implements AdminInterface
{
    /**
     * @param $entity
     */
    protected function store($entity)
    {

    }

    protected function reconstitute($id, $params = [])
    {
        // TODO: Implement reconstitute() method.
    }


    /**
     * @param $user_name
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getUser($user_name)
    {
        $query = AdminModel::find();
        $model = $query->where(['username' => $user_name])->one();
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