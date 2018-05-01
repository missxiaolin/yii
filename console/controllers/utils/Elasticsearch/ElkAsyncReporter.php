<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2018/5/1
 * Time: 下午6:29
 */

namespace console\controllers\utils\Elasticsearch;


use common\components\Common\InstanceTrait;
use console\controllers\ElkLoggerReporter;
use console\controllers\utils\Queue;

class ElkAsyncReporter
{
    use InstanceTrait;

    /**
     * 日志
     * @param $level
     * @param $message
     * @param array $context
     */
    public function log($level, $message, array $context = array())
    {
        Queue::push(new ElkLoggerReporter($level, $message, $context));
    }
}