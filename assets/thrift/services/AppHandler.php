<?php
namespace assets\thrift\services;


use Xin\Thrift\MicroService\AppIf;
use Yii;

class AppHandler extends Handler implements AppIf
{
    /**
     * @return string
     */
    public function version()
    {
        return Yii::$app->version;
    }

}