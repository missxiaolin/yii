<?php
namespace assets\thrift\services;

use Xin\Thrift\Register\RegisterIf;
use Yii;

class RegisterHandler extends Handler implements RegisterIf
{
    public function version()
    {
        // TODO: Implement version() method.
        return Yii::$app->version;
    }

    public function heartbeat(\Xin\Thrift\Register\ServiceInfo $serviceInfo)
    {
        // TODO: Implement heartbeat() method.
    }
}