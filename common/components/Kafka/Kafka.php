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
        try {
            $rcf = new \RdKafka\Conf();
            $rcf->set('group.id', 'test');
            $cf = new \RdKafka\TopicConf();
            /*
                $cf->set('offset.store.method', 'file');
            */
            $cf->set('auto.offset.reset', 'smallest');
            $cf->set('auto.commit.enable', true);

            $rk = new \RdKafka\Consumer($rcf);
            $rk->setLogLevel(LOG_DEBUG);
            $rk->addBrokers("127.0.0.1");
            $topic = $rk->newTopic("test", $cf);
            //$topic->consumeStart(0, RD_KAFKA_OFFSET_BEGINNING);
            while (true) {
                $topic->consumeStart(0, RD_KAFKA_OFFSET_STORED);
                $msg = $topic->consume(0, 1000);
                dump($msg);
                if ($msg->err) {
                    echo $msg->errstr(), "\n";
                    break;
                } else {
                    echo $msg->payload, "\n";
                }
                $topic->consumeStop(0);
                sleep(1);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}