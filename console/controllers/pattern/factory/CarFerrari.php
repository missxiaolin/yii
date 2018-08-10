<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/10
 * Time: 下午4:31
 */

namespace console\controllers\pattern\factory;


class CarFerrari implements VehicleInterface
{
    /**
     * @var string
     */
    private $color;

    public function setColor(string $rgb)
    {
        $this->color = $rgb;
    }
}