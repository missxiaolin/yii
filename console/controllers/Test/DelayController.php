<?php
namespace console\controllers\Test;


use console\controllers\contract\JobInterface;
use console\controllers\dope\Queue;
use console\controllers\dope\QueueController;
use Yii;
use yii\base\Exception;

class DelayController extends Queue
{
    public $description = '默认消息执行脚本';

    // 最大进程数
    protected $maxProcesses = 2;

    // 子进程最大循环处理次数
    protected $processHandleMaxNumber = 100;

    protected $errorKey = '';


    public function onConstruct()
    {
        $this->queueKey = Yii::$app->params['key'];
        $this->delayKey = Yii::$app->params['delayKey'];
        $this->errorKey = Yii::$app->params['errorKey'];
    }

    protected function handle($data)
    {
        try {
            $obj = unserialize($data);
            if ($obj instanceof JobInterface) {
                $name = get_class($obj);
                $obj->handle();
            }
        } catch (Exception $ex) {
            $redis = Yii::$app->redis;
            $redis->lpush($this->errorKey, $data);
        }
    }

    /**
     * @desc   重载失败的Job
     * @author limx
     */
    public function reloadErrorJobsAction()
    {
        $redis = Yii::$app->redis;
        while ($data = $redis->rpop($this->errorKey)) {
            $redis->lpush($this->queueKey, $data);
        }
        dump("失败的脚本已重新载入消息队列！");
    }

    /**
     * @desc   删除所有失败的Job
     * @author limx
     */
    public function flushErrorJobsAction()
    {
        $redis = Yii::$app->redis;
        $redis->del($this->errorKey);
        dump("失败的脚本已被清除！");
    }
}