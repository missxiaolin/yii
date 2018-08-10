<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/10
 * Time: 下午4:27
 */

namespace console\controllers\pattern\factory;

abstract class FactoryMethod
{
    const CHEAP = 'cheap';
    const FAST = 'fast';

    abstract protected function createVehicle(string $type): VehicleInterface;

    /**
     * @param string $type
     * @return VehicleInterface
     */
    public function create(string $type): VehicleInterface
    {
        $obj = $this->createVehicle($type);
        $obj->setColor('block');

        return $obj;
    }
}