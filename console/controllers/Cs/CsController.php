<?php
namespace console\controllers\Cs;

declare(ticks = 1);

use console\controllers\utils\Queue;
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

    public function actionEmail()
    {
        $email = new Email(1,2,3);
        Queue::delay($email, 5);
    }

}