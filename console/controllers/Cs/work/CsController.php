<?php
namespace console\controllers\Cs\work;

use Workerman\Worker;
use yii\console\Controller;
use Yii;

class CsController extends Controller
{
    /**
     * workman
     * @param $action
     */
    public function actionTest($action)
    {
        global $argv;
        $argv[0] = '测试脚本';
        $argv[1] = $action;
        $argv[2] = '-d';
        // 创建一个Worker监听2345端口，使用http协议通讯
        $http_worker = new Worker("http://127.0.0.1:2345");

        // 启动4个进程对外提供服务
        $http_worker->count = 4;

        // 接收到浏览器发送的数据时回复hello world给浏览器
        $http_worker->onMessage = function ($connection, $data) {
            // 向浏览器发送hello world
            $connection->send('hello world');
        };

        // 运行worker
        Worker::runAll();
    }
}