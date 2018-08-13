<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/8/13
 * Time: 上午10:30
 */

namespace console\controllers\pattern\pool;

use yii\console\Controller;
use Yii;

class PoolController extends Controller
{
    public function actionTest1()
    {
        $pool = new WorkerPool();
        $worker1 = $pool->get();
        $worker2 = $pool->get();
        dump($pool);
        dump($worker1);
        dump($worker2);
    }

    public function actionTest2()
    {
        $pool = new WorkerPool();
        $worker1 = $pool->get();
        $pool->dispose($worker1);
        $worker2 = $pool->get();

        dump($pool);
        dump($worker1, $worker2);
    }
}