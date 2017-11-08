<?php

namespace console\controllers\Test;


use common\components\thrift\clients\AppClient;
use yii\console\Controller;

class ServiceController extends Controller
{
    /**
     * 调用
     */
    public function actionIndex()
    {
        $client = AppClient::getInstance();

        dump($client->version());
    }

}