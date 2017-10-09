<?php
namespace console\controllers;

declare(ticks=1);

use yii\console\Controller;
use Yii;
use swoole_process;

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

    public static $instances;

    public function actionHandle()
    {
        ini_set('default_socket_timeout', -1);
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
                if (empty($data)) {
                    continue;
                }
                if ($data[0] != $this->queueKey) {
                    // 消息队列KEY值不匹配
                    continue;
                }
                if (isset($data[1])) {
                    $process = new swoole_process([$this, 'task']);
                    $process->write($this->rewrite($data[1]));
                    $pid = $process->start();
                    if ($pid === false) {
                        $redis->lpush($this->queueKey, $data[1]);
                    } else {
                        $this->process++;
                    }
                }
            } else {
                if (is_int($this->waittime) && $this->waittime > 0) {
                    sleep($this->waittime);
                }
            }
        }
    }

    /**
     * @desc   主进程中操作数据
     * @tip    主进程中不能实例化DB类，因为Mysql连接会中断
     *         暂时原因不明，可能是会被子进程释放掉
     * @author limx
     * @param $data 消息队列中的数据
     * @return mixed 返回给子进程的数据
     */
    protected function rewrite($data)
    {
        return $data;
    }

    /**
     * @desc   信号处理方法 回收已经dead的子进程
     * @author limx
     * @param $signo
     */
    private function signalHandler($signo)
    {
        switch ($signo) {
            case SIGCHLD:
                while (swoole_process::wait(false)) {
                    $this->process--;
                }

            default:
                break;
        }
    }

    /**
     * @desc   子进程
     * @author limx
     * @param swoole_process $worker
     */
    public function task(swoole_process $worker)
    {
        swoole_event_add($worker->pipe, function ($pipe) use ($worker) {
            // 从主进程中读取到的数据
            $recv = $worker->read();
            $this->again($recv);
            $worker->exit(0);
            swoole_event_del($pipe);
        });
    }

    /**
     * @desc   消息队列子进程逻辑
     * @author limx
     * @return mixed
     */
    public function again($recv)
    {
        $this->handle($recv);
        $redis = Yii::$app->redis;
        $number = 0;
        while (true) {
            if (isset($this->processHandleMaxNumber) && $this->processHandleMaxNumber < (++$number)) {
                // 当子进程处理次数高于一个临界值后，释放进程
                break;
            }
            // 无任务时,阻塞等待
            $data = $redis->brpop($this->queueKey, 3);
            if (empty($data)) {
                break;
            }
            if ($data[0] != $this->queueKey) {
                // 消息队列KEY值不匹配
                continue;
            }
            if (isset($data[1])) {
                $this->handle($data[1]);
            }
        }
    }

    public function handle($data)
    {
        $request = json_decode($data, true);
        dump($request);
    }

    /**
     * 测试数据
     */
    public function actionTest()
    {
        $redis = Yii::$app->redis;
        $data = [
            'name' => 'xiaolin',
            'email' => '462441355@qq.com',
            'password' => uniqid(),
        ];
        $redis->lpush($this->queueKey, json_encode($data));
//        while (true){
//            $data = $redis->brpop($this->queueKey, 3);
//            dump($data);
//        }
    }

}