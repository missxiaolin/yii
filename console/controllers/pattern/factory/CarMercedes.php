<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/10
 * Time: 下午4:30
 */

namespace console\controllers\pattern\factory;


class CarMercedes implements VehicleInterface
{
    /**
     * @var string
     */
    private $color;

    public function setColor(string $rgb)
    {
        $this->color = $rgb;
    }

    public function addAMGTuning()
    {
        // 在这里做额外的调整
    }
}