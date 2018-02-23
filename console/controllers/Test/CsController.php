<?php
namespace console\controllers\Test;

use yii\console\Controller;
use console\controllers\utils\Queue;
use console\controllers\Email;
use Yii;

class CsController extends Controller
{
    /**
     * 测试脚本 (Delay)
     */
    public function actionTest()
    {
        $email = new Email(1, 2, 3);
        Queue::push($email);
    }

    /**
     * 测试数据
     */
    public function actionEmail()
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

    /**
     * 延迟脚本
     */
    public function actionEmailDelay()
    {
        $email = new Email(1, 2, 3);
        Queue::delay($email, 5);
    }
}