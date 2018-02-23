<?php

namespace console\controllers;

use console\controllers\contract\JobInterface;
use Yii;

class Email implements JobInterface
{
    public $email;

    public $title;

    public $body;

    public function __construct($email, $title, $body)
    {
        $this->email = $email;
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * 执行函数
     */
    public function handle()
    {
        // TODO: Implement handle() method.
//        $this->sendEmail();
        dump('测试脚本');
    }

    /**
     * 发送邮件
     */
    public function sendEmail()
    {
        $mail = Yii::$app->mailer->compose();
        $mail->setTo($this->email);
        $mail->setSubject($this->title);
        $mail->setHtmlBody($this->body);
        $data = $mail->send();
        dump($data);
    }
}