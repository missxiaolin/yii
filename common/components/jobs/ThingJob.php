<?php
namespace common\components\jobs;

use linslin\yii2\curl\Curl;
use yii\queue\Job;

class ThingJob implements Job
{
    public $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @param \yii\queue\Queue $queue
     */
    public function execute($queue)
    {
        dump($this->url);
        // TODO: Implement execute() method.
    }
}

