<?php
namespace console\controllers\Test;


use console\controllers\dope\QueueController;
use console\controllers\Sys;
use yii\console\Controller;
use Yii;
use swoole_process;

class EmailController extends QueueController
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

    protected function onConstruct()
    {

    }

    /**
     * 任务脚本
     * @param $data
     */
    protected function handle($data)
    {
        $request = json_decode($data, true);
        $mail = Yii::$app->mailer->compose();
        $mail->setTo($request['email']);
        $mail->setSubject($request['title']);
        $mail->setHtmlBody($request['body']);
        $data = $mail->send();
        dump($data);
    }
}