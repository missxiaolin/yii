<?php
namespace app\src\repository;

use backend\src\interfaces\AdminInterface;
use backend\src\models\AdminModel;
use Carbon\Carbon;
use common\src\foundation\domain\Repository;
use yii\data\Pagination;

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
     * 生成访问口令
     *
     * @return string
     */
    public function generateAccessToken()
    {
        return md5(uniqid("xl_account", true));
    }

    public function setToken($username)
    {
        $query = AdminModel::find();
        $model = $query->where(['username' => $username])->one();
        $model->access_token = $this->generateAccessToken();
        $model->expires_at = Carbon::now()->addMinute(3600);
        $model->save();
        return $model;
    }

    /**
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     */
    public function getUserId($id)
    {
        $query = AdminModel::find();
        $model = $query->where(['id' => $id])->one();
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

    /**
     * 管理员列表
     * @return array
     */
    public function getList()
    {
        $query = AdminModel::find();
        $query->orderBy('created_at desc');
        $pagers = new Pagination(['totalCount' => $query->count(), 'pageSize' => 10]);
        $models = $query->offset($pagers->offset)->limit($pagers->limit)->all();

        return [$models, $pagers];
    }

}