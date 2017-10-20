<?php
namespace console\controllers\Cs\email;

use Yii;

class Email
{
    /**
     * @param $serv
     * @param $fd
     * @param $fromId
     * @param $data
     */
    public function receive($serv, $fd, $fromId, $data)
    {

    }

    /**
     * @param $serv
     * @param $taskId
     * @param $fromId
     * @param $data
     * @return bool
     * @throws \Exception
     */
    public function task($serv, $taskId, $fromId, $data)
    {
        try {
            return $this->sendEmail($data);

        } catch (\Exception $e) {
            throw new \Exception('task exception :' . $e->getMessage());
        }
    }

    /**
     * @param $data
     * @return bool
     */
    public function sendEmail($data)
    {
        $mail = Yii::$app->mailer->compose();
        $mail->setTo($data['email']);
        $mail->setSubject($data['title']);
        $mail->setHtmlBody($data['body']);
        return $mail->send();
    }
}