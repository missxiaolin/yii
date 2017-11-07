<?php

namespace assets\src\repository;

use JsonSerializable;
use Xin\Thrift\Register\ServiceInfo;

class RegisterInput implements JsonSerializable
{
    public $inputArray;


    public function __construct(ServiceInfo $input)
    {

    }

    /**
     * @return mixed
     */
    public function toArray()
    {
        return $this->inputArray;
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return json_encode($this->inputArray);
    }
}