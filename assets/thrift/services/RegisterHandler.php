<?php
namespace assets\thrift\services;

use Xin\Thrift\Register\ServiceInfo;
use Xin\Thrift\Register\RegisterIf;
use Yii;

class RegisterHandler extends Handler implements RegisterIf
{
    public function version()
    {
        // TODO: Implement version() method.
        return Yii::$app->version;
    }


    public function heartbeat(ServiceInfo $serviceInfo)
    {
        // TODO: Implement heartbeat() method.
    }
}