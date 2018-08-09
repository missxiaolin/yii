<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/9
 * Time: 下午3:03
 */

namespace console\controllers\pattern\build;


use console\controllers\pattern\build\parts\Vehicle;

interface BuilderInterface
{
    public function createVehicle();

    public function addWheel();

    public function addEngine();

    public function addDoors();

    public function getVehicle(): Vehicle;
}