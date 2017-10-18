<?php
namespace common\components\Event;

class Email
{
    public static function handle($even)
    {
        echo '发送邮件';
        exit;
    }
}