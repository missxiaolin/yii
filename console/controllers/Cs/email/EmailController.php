<?php
namespace console\controllers\Cs\email;

use yii\console\Controller;
use swoole_client;
use Yii;


class EmailController extends Controller
{
    private $client;

    /**
     * 测试用
     * @param $email
     * @param $title
     * @param $body
     */
    public function actionTest($email, $title, $body)
    {
        $data = [
            'email' => $email,
            'title' => $title,
            'body' => $body,
        ];
        $this->sendData($data);
    }


    /**
     * @param $data
     * @return bool
     * @throws \Exception
     */
    public function sendData($data)
    {
        $this->client = new swoole_client(SWOOLE_SOCK_TCP);
        if (!$this->client->connect('127.0.0.1', 9501)) {
            $msg = 'swoole client connect failed.';
            throw new \Exception("Error: {$msg}.");
        }
        if (!is_array($data)) {
            return false;
        }
        $data = json_encode($data) . "\r\n";
        $this->client->send($data);
    }


}