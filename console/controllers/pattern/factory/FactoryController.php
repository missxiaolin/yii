<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/10
 * Time: 下午4:34
 */

namespace console\controllers\pattern\factory;

use yii\console\Controller;
use Yii;

class FactoryController extends Controller
{
    public function actionTest()
    {
        $factory = new ItalianFactory();
        $result = $factory->create(FactoryMethod::CHEAP);

        dump($result);

        $factory = new ItalianFactory();
        $result = $factory->create(FactoryMethod::FAST);

        dump($result);
    }
}