<?php
namespace console\controllers\Cs\Swoole;


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
            $serv->send($fd, 'Server ' . $data);
        });

        // 客户端断开连接或者server主动关闭连接时 worker进程内调用
        $serv->on('Close', function ($serv, $fd) {
            echo "Client close." . PHP_EOL;
        });
        $serv->start();
    }

    /**
     * 开启swoole (task)
     */
    public function actionTask()
    {
        $serv = new swoole_server('127.0.0.1', 9501);
        $serv->set([
            'task_worker_num' => 1,
        ]);

        $serv->on('Connect', function ($serv, $fd) {
            echo "new client connected." . PHP_EOL;
        });

        $serv->on('Receive', function ($serv, $fd, $fromId, $data) {
            echo "worker received data: {$data}" . PHP_EOL;

            // 投递一个任务到task进程中
            $serv->task($data);

            // 通知客户端server收到数据了
            $serv->send($fd, 'This is a message from server.');

            // 为了校验task是否是异步的，这里和task进程内都输出内容，看看谁先输出
            echo "worker continue run."  . PHP_EOL;
        });

        /**
         * $serv swoole_server
         * $taskId 投递的任务id,因为task进程是由worker进程发起，所以多worker多task下，该值可能会相同
         * $fromId 来自那个worker进程的id
         * $data 要投递的任务数据
         */
        $serv->on('Task', function ($serv, $taskId, $fromId, $data) {
            echo "task start. --- from worker id: {$fromId}." . PHP_EOL;
            for ($i=0; $i < 5; $i++) {
                sleep(1);
                echo "task runing. --- {$i}" . PHP_EOL;
            }
            echo "task end." . PHP_EOL;
        });

        /**
         * 只有在task进程中调用了finish方法或者return了结果，才会触发finish
         */
        $serv->on('Finish', function ($serv, $taskId, $data) {
            echo "finish received data '{$data}'" . PHP_EOL;
        });

        // 客户端断开连接或者server主动关闭连接时 worker进程内调用
        $serv->on('Close', function ($serv, $fd) {
            echo "Client close." . PHP_EOL;
        });
        $serv->start();
    }

    /**
     * 模拟发送数据（actionTest actionTask）
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

    /**
     * 最大执行
     * max_request的含义是worker进程的最大任务数
     * task_max_request针对task进程，含义同max_request
     * Worker进程的最大任务设置为3次，Task进程的最大任务设置为4次。
     */
    public function actionMaxRequest()
    {
        $serv = new swoole_server('127.0.0.1', 9501);

        $serv->set([
            'worker_num' => 1,
            'task_worker_num' => 1,
            'max_request' => 3,
            'task_max_request' => 4,
        ]);
        $serv->on('Connect', function ($serv, $fd) {
        });
        $serv->on('Receive', function ($serv, $fd, $fromId, $data) {
            $serv->task($data);
        });
        $serv->on('Task', function ($serv, $taskId, $fromId, $data) {
        });
        $serv->on('Finish', function ($serv, $taskId, $data) {
        });
        $serv->on('Close', function ($serv, $fd) {
        });
        $serv->start();
    }

    /**
     * 模拟发送数据（actionMaxRequest）
     */
    public function actionSendMax()
    {
        $client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_SYNC);
        $client->connect('127.0.0.1', 9501) || exit("connect failed. Error: {$client->errCode}\n");

// 向服务端发送数据
        $client -> send("Just a test.");
        $client->close();
    }


}