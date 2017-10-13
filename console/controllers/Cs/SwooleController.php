<?php
namespace console\controllers\Cs;


use yii\console\Controller;
use swoole_server;
use swoole_client;
use Yii;

class SwooleController extends Controller
{
    /**
     * 开启swoole
     */
    public function actionTest()
    {
        $serv = new swoole_server('127.0.0.1', 9501);
        $serv->on('Connect', function ($serv, $fd) {
            echo "new client connected." . PHP_EOL;
        });

        // server接收到客户端的数据后，worker进程内触发该回调
        $serv->on('Receive', function ($serv, $fd, $fromId, $data) {
            // 收到数据后发送给客户端
            $serv->send($fd, 'Server '. $data);
        });

        // 客户端断开连接或者server主动关闭连接时 worker进程内调用
        $serv->on('Close', function ($serv, $fd) {
            echo "Client close." . PHP_EOL;
        });
        $serv->start();
    }

    /**
     * 模拟发送数据
     */
    public function actionSend()
    {
        $client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_SYNC);
        $client->connect('127.0.0.1', 9501) || exit("connect failed. Error: {$client->errCode}\n");
        $client->send("hello server.");
        $response = $client->recv();
        echo $response . PHP_EOL;
        $client->close();
    }

}