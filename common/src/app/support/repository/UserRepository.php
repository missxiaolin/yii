<?php

namespace common\src\app\domain\support\repository;

use common\src\app\domain\support\interfaces\UserInterface;
use common\src\foundation\domain\Repository;

class UserRepository extends Repository implements UserInterface
{
    protected function store($entity)
    {
        // TODO: Implement store() method.
    }

    protected function reconstitute($id, $params = [])
    {
        // TODO: Implement reconstitute() method.
    }

}