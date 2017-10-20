<?php
namespace console\controllers\Cs\Swoole;


use yii\console\Controller;
use swoole_server;
use swoole_client;
use Yii;

class SwoolePackController extends Controller
{
    private $_serv;

    /**
     * 执行
     */
    public function actionTest()
    {
        $this->_serv = new swoole_server("127.0.0.1", 9501);
        $this->_serv->set([
            'worker_num' => 1,
            'open_length_check'     => true,      // 开启协议解析
            'package_length_type'   => 'N',     // 长度字段的类型
            'package_length_offset' => 0,       //第几个字节是包长度的值
            'package_body_offset'   => 4,       //第几个字节开始计算长度
            'package_max_length'    => 81920,  //协议最大长度
        ]);
        $this->_serv->on('Receive', [$this, 'onReceive']);
        $this->_serv->start();
    }

    public function onReceive($serv, $fd, $fromId, $data)
    {
        $info = unpack('N', $data);
        $len = $info[1];
        $body = substr($data, - $len);
        echo "server received data: {$body}\n";
    }

    /**
     * 发送数据
     */
    public function actionSend()
    {
        $client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_SYNC);
        $client->connect('127.0.0.1', 9501) || exit("connect failed. Error: {$client->errCode}\n");

// 向服务端发送数据
        for ($i = 0; $i < 3; $i++) {
            $data = "Just a test.";
            $data = pack('N', strlen($data)) . $data;
            $client->send($data);
        }

        $client->close();
    }
}