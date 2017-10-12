<?php
namespace console\controllers\Cs;


use common\components\Yii2Resque;
use Psr\Log\LogLevel;
use Resque_Log;
use Resque_Redis;
use Resque_Worker;
use ResqueScheduler_Worker;
use yii\console\Controller;
use Resque;
use Yii;

class ResqueController extends Controller
{

    /**
     * 启动消费 QUEUE_ORDERS 队列的 Worker
     *
     * ./yii resque/orders >> /var/log/resque/orders.log &
     */
    public function actionOrders()
    {
        $this->startWorkers(Yii2Resque::QUEUE_ORDERS, 3);
    }

    /**
     * 启动 worker
     *
     * @param $queue_name string 队列名称
     * @param $count integer worker个数，默认1个
     * @param $interval integer 间隔秒数，默认5秒
     * @param $prefix string Redis命名空间(前缀)，默认: resque
     */
    private function startWorkers($queue_name, $count = 1, $interval = 5, $prefix = null)
    {
        // 设置Redis
        $redis = Yii::$app->redis;
        $REDIS_BACKEND = "redis://:$redis->password@$redis->hostname:$redis->port";
        Resque::setBackend($REDIS_BACKEND);

        // 设置Redis命名空间前缀，默认:resque
        if (!empty($prefix)) {
            Resque_Redis::prefix($prefix);
        }

        // 设置日志
        if (!isset($logger) || !is_object($logger)) {
            $logger = new Resque_Log(false);
        }

        // 启动 Worker
        if ($count > 1) {
            for ($i = 0; $i < $count; ++$i) {
                $pid = Resque::fork();
                if ($pid === false || $pid === -1) {
                    $logger->log(LogLevel::EMERGENCY, 'Could not fork worker {count}', array('count' => $i));
                    die();
                } else if (!$pid) {
                    // Child, start the worker
                    $queues = explode(',', $queue_name);
                    $worker = new Resque_Worker($queues);
                    $worker->setLogger($logger);
                    $logger->log(LogLevel::NOTICE, 'Starting worker {worker}', array('worker' => $worker));
                    $worker->work($interval);
                    break;
                }
            }
        } else {
            // Start a single worker
            $queues = explode(',', $queue_name);
            $worker = new Resque_Worker($queues);
            $worker->setLogger($logger);
            $logger->log(LogLevel::NOTICE, 'Starting worker {worker}', array('worker' => $worker));
            $worker->work($interval);
        }


    }


    /**
     * 启动计划任务消费的 Worker
     *
     * ./yii resque/start-schedule >> /var/log/resque/schedule.log &
     */
    public function actionStartSchedule()
    {
        // 设置Redis
        $redis = Yii::$app->redis;
        $REDIS_BACKEND = "redis://:$redis->password@$redis->hostname:$redis->port";
        Resque::setBackend($REDIS_BACKEND);
        // 启动计划任务 Worker
        $worker = new ResqueScheduler_Worker();
        $worker->logLevel = ResqueScheduler_Worker::LOG_NORMAL;
        fwrite(STDOUT, "*** Starting scheduler worker\n");
        $worker->work(5);
    }

}