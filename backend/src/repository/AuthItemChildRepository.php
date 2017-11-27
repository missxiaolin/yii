<?php
namespace backend\src\repository;

use backend\src\interfaces\AuthItemChildInterface;
use common\src\foundation\domain\Repository;
use Yii;

class AuthItemChildRepository extends Repository implements AuthItemChildInterface
{

    /**
     * @param \common\src\foundation\domain\Entity $entity
     */
    public function store($entity)
    {
        // TODO: Implement store() method.
    }

    /**
     * @param mixed $id
     * @param array $params
     */
    public function reconstitute($id, $params = [])
    {
        // TODO: Implement reconstitute() method.
    }

    /**
     * 添加权限
     * @param $children
     * @param $name
     * @return bool
     */
    public function addChild($children, $name)
    {
        $auth = Yii::$app->authManager;
        $itemObj = $auth->getRole($name);
        if (empty($itemObj)) {
            return false;
        }
        $trans = Yii::$app->db->beginTransaction();
        try {
            $auth->removeChildren($itemObj);
            foreach ($children as $item) {
                $obj = empty($auth->getRole($item)) ? $auth->getPermission($item) : $auth->getRole($item);
                $auth->addChild($itemObj, $obj);
            }
            $trans->commit();
        } catch(\Exception $e) {
            $trans->rollback();
            return false;
        }
        return true;
    }

}