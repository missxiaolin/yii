<?php
namespace common\components\Kafka;

use RdKafka;

class Kafka
{
    public $broker_list = 'localhost';
    public $topic = "test";
    public $partition = 0;

    //public $logFile = '@runtime/logs/kafka/info.log';

    protected $producer = null;
    protected $consumer = null;

    public function __construct()
    {
        if (empty($this->broker_list)) {
            throw new \yii\base\InvalidConfigException("broker not config");
        }
        $rk = new \RdKafka\Producer();
        if (empty($rk)) {
            throw new \yii\base\InvalidConfigException("producer error");
        }
        $rk->setLogLevel(LOG_DEBUG);
        if (!$rk->addBrokers($this->broker_list)) {
            throw new \yii\base\InvalidConfigException("producer error");
        }
        $this->producer = $rk;
    }

    public function send()
    {
        try {
            $rcf = new \RdKafka\Conf();
            $rcf->set('group.id', 'test');
            $cf = new \RdKafka\TopicConf();
            $cf->set('offset.store.method', 'broker');
            $cf->set('auto.offset.reset', 'smallest');

            $rk = new \RdKafka\Producer($rcf);
            $rk->setLogLevel(LOG_DEBUG);
            $rk->addBrokers($this->broker_list);
            $topic = $rk->newTopic("test", $cf);
            for ($i = 0; $i < 1000; $i++) {
                $topic->produce(0, 0, 'test' . $i);
            }
        } catch (\Exception $e) {
            dump('error' . $e->getMessage());
        }
    }

    public function consumer($object, $callback)
    {
        $conf = new \RdKafka\Conf();
        $conf->set('group.id', 0);
        $conf->set('metadata.broker.list', $this->broker_list);

        $topicConf = new \RdKafka\TopicConf();
        $topicConf->set('auto.offset.reset', 'smallest');

        $conf->setDefaultTopicConf($topicConf);

        $consumer = new \RdKafka\KafkaConsumer($conf);

        $consumer->subscribe([$this->topic]);

        echo "waiting for messages.....\n";
        while(true) {
            $message = $consumer->consume(120*1000);
            switch ($message->err) {
                case RD_KAFKA_RESP_ERR_NO_ERROR:
                    echo "message payload....";
                    $object->$callback($message->payload);
                    break;
            }
            sleep(1);
        }
    }

}