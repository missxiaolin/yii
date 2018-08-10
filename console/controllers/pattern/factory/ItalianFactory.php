<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/10
 * Time: 下午4:28
 */

namespace console\controllers\pattern\factory;


class ItalianFactory extends FactoryMethod
{
    protected function createVehicle(string $type): VehicleInterface
    {
        switch ($type) {
            case parent::CHEAP:
                return new Bicycle();
            case parent::FAST:
                return new CarFerrari();
            default:
                throw new \InvalidArgumentException("$type is not a valid vehicle");
        }
    }
}