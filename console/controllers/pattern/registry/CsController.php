<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/14
 * Time: 下午4:10
 */

namespace console\controllers\pattern\registry;

use yii\console\Controller;
use stdClass;

class CsController extends Controller
{
    public function actionTest1()
    {
        $key = Registry::LOGGER;
        $logger = new stdClass();

        Registry::set($key, $logger);
        $storedLogger = Registry::get($key);
        dump($logger);
        dump($storedLogger);
    }

    public function actionTest2()
    {
        Registry::set('logger', new stdClass());
        dump(Registry::get(Registry::LOGGER));
    }
}