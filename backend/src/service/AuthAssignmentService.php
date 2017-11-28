<?php
namespace backend\src\service;

use backend\src\repository\AuthAssignmentRepository;
use Yii;

class AuthAssignmentService
{
    /**
     * @param $admin_id
     * @param $children
     * @return bool
     */
    public function grant($admin_id, $children)
    {
        $repository = new AuthAssignmentRepository();
        return $repository->grant($admin_id, $children);
    }
}