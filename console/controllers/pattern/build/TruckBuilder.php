<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/9
 * Time: 下午3:03
 */

namespace console\controllers\pattern\build;


use console\controllers\pattern\build\parts\Door;
use console\controllers\pattern\build\parts\Engine;
use console\controllers\pattern\build\parts\Truck;
use console\controllers\pattern\build\parts\Vehicle;
use console\controllers\pattern\build\parts\Wheel;

class TruckBuilder implements BuilderInterface
{
    /**
     * @var Vehicle
     */
    private $truck;

    public function addDoors()
    {
        $this->truck->setPart('rightDoor', new Door());
        $this->truck->setPart('leftDoor', new Door());
    }

    public function addEngine()
    {
        $this->truck->setPart('truckEngine', new Engine());
    }

    public function addWheel()
    {
        $this->truck->setPart('wheel1', new Wheel());
        $this->truck->setPart('wheel2', new Wheel());
        $this->truck->setPart('wheel3', new Wheel());
        $this->truck->setPart('wheel4', new Wheel());
        $this->truck->setPart('wheel5', new Wheel());
        $this->truck->setPart('wheel6', new Wheel());
    }

    public function createVehicle()
    {
        $this->truck = new Truck();
    }

    /**
     * @return Vehicle
     */
    public function getVehicle(): Vehicle
    {
        return $this->truck;
    }
}