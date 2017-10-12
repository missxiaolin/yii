<?php
namespace console\controllers\Test;

use console\controllers\dope\WebSocket;
use swoole_websocket_frame;
use swoole_websocket_server;

class WebSocketController extends WebSocket
{
    protected $prot = 9501;

    /**
     * 初始化数据
     */
    protected function onConstruct()
    {
        // TODO: Implement onConstruct() method.
    }

    /**
     * @desc    WebSocket 连接到服务器
     * @author  limx
     * @param swoole_websocket_server $server
     * @param                         $request
     */
    protected function connect(swoole_websocket_server $server, $request)
    {
        // TODO: Implement connect() method.
        echo "server: handshake success with fd{$request->fd}.\n";
    }

    /**
     * @desc   WebSocket 收到客户端消息
     * @author limx
     * @param swoole_websocket_server $server
     * @param swoole_websocket_frame $frame
     */
    protected function message(swoole_websocket_server $server, swoole_websocket_frame $frame)
    {
        // TODO: Implement message() method.
        // 循环当前的所有连接，并把接收到的客户端信息全部发送
        foreach ($server->connections as $fd) {
            $server->push($fd, $frame->data);
        }
    }

    /**
     * @desc   WebSocket 断开连接
     * @author limx
     * @param $ser
     * @param $fd
     * @return mixed
     */
    protected function close($ser, $fd)
    {
        // TODO: Implement close() method.
        echo "client {$fd} closed.\n";
    }


}