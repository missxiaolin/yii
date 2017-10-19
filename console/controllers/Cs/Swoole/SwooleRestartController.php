<?php
namespace console\controllers\Cs\Swoole;


use console\controllers\Sys;
use yii\console\Controller;
use swoole_server;
use swoole_client;
use Yii;

class SwooleRestartController extends Controller
{
    private $_serv;
    private $_test;

    /**
     * swoole 启动
     * new Swoole\Server(可以这么写)
     * 守护进程（平滑重启）
     */
    public function actionTest()
    {
        $this->_serv = new swoole_server("127.0.0.1", 9501);
        $this->_serv->set([
            'worker_num' => 1,
            'daemonize' => true,
            'log_file' => '/Users/mac/web/ceshi/console/runtime/logs/server.log',
        ]);
        $this->_serv->on('Receive', [$this, 'onReceive']);
        $this->_serv->on('WorkerStart', [$this, 'onWorkerStart']);

        $this->_serv->start();

    }

    public function onWorkerStart($serv, $workerId)
    {
        $this->_test = new Sys();
    }

    /**
     * 客户端发送过来的数据做处理
     */
    public function onReceive($serv, $fd, $fromId, $data)
    {
        $this->_test->run();
    }

    /**
     * 发送数据
     */
    public function actionSend()
    {
        $client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_SYNC);
        $client->connect('127.0.0.1', 9501) || exit("connect failed. Error: {$client->errCode}\n");

// 向服务端发送数据
        $client->send("Just a test");
        $client->close();
    }


}