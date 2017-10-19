<?php
namespace console\controllers\Cs\Swoole;

use yii\console\Controller;
use swoole_server;
use swoole_client;
use swoole_timer_tick;
use swoole_timer_after;
use Yii;

class SwooleTimerController extends Controller
{
    /**
     * swoole 定时器
     */
    public function actionTest()
    {
        $i = 0;

        swoole_timer_tick(1000, function ($timeId, $params) use (&$i) {
            $i ++;
            echo "hello, {$params} --- {$i}\n";
            if ($i >= 5) {
                swoole_timer_clear($timeId);
            }
        }, 'world');
    }

    /**
     * 一次性定时器
     */
    public function actionTimeAfter()
    {
        swoole_timer_after(3000, function () {
            echo "only once.\n";
        });
    }

}