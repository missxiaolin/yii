<?php
namespace common\components\Service;

use common\components\Common\InstanceTrait;
use common\components\Train;

class BasicService implements HanderInterface
{
    use InstanceTrait;

    public function version()
    {
        return '1.0';
    }

    /**
     * @desc   计算经纬度所在地区
     * @author limx
     */
    public function predict($lat, $lon)
    {
        return Train::getInstance()->predict([$lat, $lon]);
    }
}
