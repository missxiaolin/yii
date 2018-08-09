<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/9
 * Time: 下午3:09
 */

namespace console\controllers\pattern\build;

use yii\console\Controller;
use Yii;

class BuildController extends Controller
{
    public function actionTest()
    {
        $truckBuilder = new TruckBuilder();
        $director = new Director();
        $newVehicle = $director->build($truckBuilder);
        dump($newVehicle->getData());
    }
}