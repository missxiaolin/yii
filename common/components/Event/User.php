<?php
namespace common\components\Event;

class User
{
    public static function handle($even)
    {
        echo "我给管理员发了邮件";
    }
}