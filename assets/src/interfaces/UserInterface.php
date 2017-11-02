<?php

namespace assets\src\interfaces;

use common\src\foundation\domain\interfaces\Repository;

interface UserInterface extends Repository
{

    /**
     * @param $email
     * @return mixed
     */
    public function getEmail($email);

    /**
     * @param $db_password
     * @param $auth_key
     * @param $password
     * @return mixed
     */
    public function validatePassword($db_password, $auth_key, $password);

}