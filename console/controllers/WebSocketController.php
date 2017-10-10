<?php
namespace console\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\console\Controller;

class WebSocketController extends Controller
{
    public function actionTest()
    {
        echo '启动websocket' . PHP_EOL;
        $serv = new \swoole_websocket_server("127.0.0.1", 9501);
        $serv->set([
            'worker_num' => 1,
        ]);
        $serv->on('open', [$this, 'onOpen']);
        $serv->on('message', [$this, 'onMessage']);
        $serv->on('close', [$this, 'onClose']);
        $serv->start();
    }

    /**
     * 客户端与服务端建立连接的时候将触发该回调,回调的第二个参数是swoole_http_request对象，包括了http握手的一些信息，比如GET\COOKIE等
     * @param $serv
     * @param $request
     */
    public function onOpen(\swoole_websocket_server $serv, $request)
    {
        echo "server: handshake success with fd{$request->fd}.\n";
    }

    /**
     * 这个是服务端收到客户端信息后回调，在该回调内我们调用了swoole_websocket_server::push方法向客户端推送了数据，注意哦，push的第一个参数只能是websocket客户端的标识
     * @param $serv
     * @param $frame
     */
    public function onMessage(\swoole_websocket_server $serv, $frame)
    {
        // 循环当前的所有连接，并把接收到的客户端信息全部发送
        foreach ($serv->connections as $fd) {
            $serv->push($fd, $frame->data);
        }
    }

    public function onClose(\swoole_websocket_server $serv, $fd)
    {
        echo "client {$fd} closed.\n";
    }


    public function actionSave()
    {
        $client = new \swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_SYNC);
        $client->connect('127.0.0.1', 9501) || exit("connect failed. Error: {$client->errCode}\n");

        // 向服务端发送数据
        $client->send("Just a test.\n");
        $client->close();
    }


}