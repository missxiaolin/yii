<?php
namespace backend\src\repository;

use backend\src\interfaces\AuthAssignmentInterface;
use common\src\foundation\domain\Repository;
use Yii;

class AuthAssignmentRepository extends Repository implements AuthAssignmentInterface
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
     * @param $admin_id
     * @param $children
     * @return bool
     */
    public function grant($admin_id, $children)
    {
        $trans = Yii::$app->db->beginTransaction();
        try {
            $auth = Yii::$app->authManager;
            $auth->revokeAll($admin_id);
            foreach ($children as $item) {
                $obj = empty($auth->getRole($item)) ? $auth->getPermission($item) : $auth->getRole($item);
                $auth->assign($obj, $admin_id);
            }
            $trans->commit();
        } catch (\Exception $e) {
            $trans->rollback();
            return false;
        }
        return true;
    }

}