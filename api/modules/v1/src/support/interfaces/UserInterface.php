<?php

namespace api\modules\v1\src\support\interfaces;

use common\src\foundation\domain\interfaces\Repository;

interface UserInterface extends Repository
{
    /**
     * @param $token
     * @return mixed
     */
    public function getToken($token);
}