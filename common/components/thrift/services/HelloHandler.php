<?php
namespace common\components\thrift\services;

use Xin\Thrift\HelloThrift\HelloServiceIf;
use Yii;

class HelloHandler implements HelloServiceIf
{
    public function sayHello($username)
    {
        // TODO: Implement sayHello() method.
        return "Hello ".$username;
    }
}