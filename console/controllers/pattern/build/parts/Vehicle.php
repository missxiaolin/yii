<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/9
 * Time: 下午3:06
 */

namespace console\controllers\pattern\build\parts;

abstract class Vehicle
{
    /**
     * @var object[]
     */
    private $data = [];

    /**
     * @param string $key
     * @param object $value
     */
    public function setPart($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @return object[]
     */
    public function getData()
    {
        return $this->data;
    }
}