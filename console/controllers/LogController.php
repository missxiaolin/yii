<?php
namespace console\controllers;

use yii\console\Controller;
use Yii;

class LogController extends Controller
{
    // 最大进程数
    protected $maxProcesses = 2;

    // 当前进程数
    protected $process = 0;

    // 消息队列Redis键值
    protected $queueKey = Sys::REDIS_KEY_QUEUE_KEY;

    // 延时消息队列的Redis键值 zset
    protected $delayKey = '';

    // 等待时间
    protected $waittime = 1;

    protected $processHandleMaxNumber = 1000;

    public function actionHandle()
    {
        if (!extension_loaded('swoole')) {
            print_r('The swoole extension is not installed');
            return;
        }

        // install signal handler for dead kids
        pcntl_signal(SIGCHLD, [$this, "signalHandler"]);
        set_time_limit(0);
        $redis = Yii::$app->redis;
        while (true) {
            // 监听消息队列
            if ($this->process < $this->maxProcesses) {
                // 无任务时,阻塞等待
                $data = $redis->brpop($this->queueKey, 3);
                if (!$data) {
                    continue;
                }
            }
        }
    }


}