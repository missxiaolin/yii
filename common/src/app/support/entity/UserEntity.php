<?php

namespace common\src\app\domain\support\entity;


use Carbon\Carbon;
use common\src\foundation\domain\Entity;

class UserEntity extends Entity
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $auth_key;

    /**
     * @var string
     */
    public $password_hash;

    /**
     * @var string
     */
    public $token;

    /**
     * @var string
     */
    public $email;

    /**
     * @var int
     */
    public $status;


    public function __construct()
    {

    }

    public function toArray($is_filter_null = false)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'auth_key' => $this->auth_key,
            'password_hash' => $this->password_hash,
            'token' => $this->token,
            'email' => $this->email,
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }

}
