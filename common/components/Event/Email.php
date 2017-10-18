<?php
namespace common\components\Event;

class Email
{
    /*
     * 事件执行
     */
    public static function handle($even)
    {
        $data = $even->sender->params ?? [];
        if (!empty($data)){

        }
    }
}