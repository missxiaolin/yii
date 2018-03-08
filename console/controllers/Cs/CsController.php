<?php
namespace console\controllers\Cs;

declare(ticks = 1);

use common\components\Yii2Resque;
use console\controllers\Email;
use console\controllers\Sys;
use console\controllers\utils\Queue;
use console\jobs\OrderJob;
use yii\console\Controller;
use Yii;

class CsController extends Controller
{
    // 消息队列Redis键值
    protected $queueKey = Sys::REDIS_KEY_QUEUE_KEY;

    /**
     * 测试数据
     */
    public function actionTest()
    {
        $redis = Yii::$app->redis;
        $data = [
            'email' => '462441355@qq.com',
            'title' => '请验证您的邮箱',
            'body' => '内容',
        ];
        $redis->lpush($this->queueKey, json_encode($data));
//        while (true){
//            $data = $redis->brpop($this->queueKey, 3);
//            dump($data);
//        }
    }

    public function actionEmail()
    {
        $email = new Email(1, 2, 3);
        Queue::delay($email, 5);
    }

    /**
     * 测试需要即时消费的订单任务
     */
    public function actionOrder()
    {
        $work = Yii::$app->resque->createJob(Yii2Resque::QUEUE_ORDERS, OrderJob::class, ["id" => 100]);
        dump($work);
    }

    /**
     * 测试需要延时消费的订单任务
     */
    public function actionDelayOrder()
    {
        Yii::$app->resque->enqueueJobIn(10, Yii2Resque::QUEUE_ORDERS, OrderJob::class, ["id" => 666]); //延迟10s执行
    }

    public function actionSendEmail()
    {
        $mail = Yii::$app->mailer->compose();
        $mail->setTo('462441355@qq.com');
        $mail->setSubject("请验证您的邮箱");
        $mail->setHtmlBody('内容');
        $mail->send();
    }
}