<?php

namespace api\modules\v1\src\support\interfaces;

interface UserInterface
{
    /**
     * @param $token
     * @return mixed
     */
    public function getToken($token);
}