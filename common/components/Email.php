<?php
namespace common\components;

use Yii;

class Email
{
    /**
     * 发送邮件
     * @param $email
     * @param $title
     * @param $body
     */
    public function sendEmail($email, $title, $body)
    {
        $mail = Yii::$app->mailer->compose();
        $mail->setTo($email);
        $mail->setSubject($title);
        $mail->setHtmlBody($body);
        $data = $mail->send();
        dump($data);
    }
}