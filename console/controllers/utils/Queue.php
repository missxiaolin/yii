<?php

namespace console\controllers\utils;

use Yii;

class Queue
{
    /**
     * @param $job
     */
    public static function push($job)
    {
        $redis_key = Yii::$app->params['key'];
        $redis = Yii::$app->redis;
        $redis->lpush($redis_key, serialize($job));
    }

    /**
     * 延迟脚本
     * @param $job
     * @param $second
     */
    public static function delay($job, $second)
    {
        $redis_key = Yii::$app->params['delayKey'];
        $redis = Yii::$app->redis;
        $redis->zadd($redis_key, time() + $second, serialize($job));
    }
}