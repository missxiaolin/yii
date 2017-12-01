<?php
namespace console\controllers\utils\Elasticsearch;

use Elasticsearch\Client as ElasticsearchClient;
use Elasticsearch\ClientBuilder;
use Yii;

class Client
{
    public static $_instance;

    public static function getInstance()
    {
        if (isset(static::$_instance) && static::$_instance instanceof ElasticsearchClient) {
            return static::$_instance;
        }
        $host = Yii::$app->params['el-host'];
        return static::$_instance = ClientBuilder::create()->setHosts([$host])->build();
    }
}