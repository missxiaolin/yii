<?php
namespace console\controllers\Cs;

use common\components\Kafka\Kafka;
use yii\console\Controller;
use Exception;
use Yii;

class KafkaController extends Controller
{
    /**
     * 添加
     */
    public function actionIndex()
    {
        $kafka = new Kafka();
        $kafka->send();
    }

    /**
     * 消费
     */
    public function actionConsumer()
    {
        $kafka = new Kafka();
        $kafka->consumer($this,'handle');
    }

    /**
     * @param $message
     */
    public function handle($message)
    {
        dump($message);
        Yii::info($message);
    }
}