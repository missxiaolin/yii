<?php

namespace backend\src\entity;


use Carbon\Carbon;
use common\src\foundation\domain\Entity;

class RoleEntity extends Entity
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $type;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $rule_name;

    /**
     * @var string
     */
    public $data;


    public function __construct()
    {
    }

    public function toArray($is_filter_null = false)
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
            'rule_name' => $this->rule_name,
            'data' => $this->data,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }

}
