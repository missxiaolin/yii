<?php

namespace app\src\entity;

use common\src\foundation\domain\Entity;

class AdminEntity extends Entity
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var int
     */
    public $auth_key;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $access_token;


    public function __construct()
    {
    }

    public function toArray($is_filter_null = false)
    {
        return [
            'username' => $this->username,
            'auth_key' => $this->auth_key,
            'password' => $this->password,
            'access_token' => $this->access_token,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }

}
