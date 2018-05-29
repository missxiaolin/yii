<?php

namespace console\controllers\districts;

use yii\console\Controller;
use Yii;
use swoole_server;

abstract class RpcServer extends Controller
{
    /**
     * host
     * @var string
     */
    protected $host;

    /**
     * 端口号
     * @var int
     */
    protected $port;

    /**
     * 配置项
     * @var array
     */
    protected $config;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->mainAction();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function mainAction()
    {
        if (!extension_loaded('swoole')) {
            dump('The swoole extension is not installed');
            return;
        }

        set_time_limit(0);
        $server = new swoole_server($this->host, $this->port);

        $server->set($this->config);

        $server->on('receive', [$this, 'receive']);
        $server->on('workerStart', [$this, 'workerStart']);

        $this->beforeServerStart($server);

        $server->start();
    }

    /**
     * @param swoole_server $server
     */
    public function beforeServerStart(swoole_server $server)
    {
        echo "-------------------------------------------" . PHP_EOL;
        echo "     Socket服务器开启 端口：" . $this->port . PHP_EOL;
        echo "-------------------------------------------" . PHP_EOL;
    }

    /**
     * 成功返回
     * @param $result
     * @return string
     */
    public function success($result)
    {
        return json_encode([
            'success' => true,
            'data' => $result,
        ]);
    }

    /**
     * 错误返回
     * @param $code
     * @param $message
     * @return string
     */
    public function fail($code, $message)
    {
        return json_encode([
            'success' => false,
            'errorCode' => $code,
            'message' => $message,
        ]);
    }

    /**
     * @param swoole_server $server
     * @param $workerId
     * @return mixed
     */
    abstract protected function workerStart(swoole_server $server, $workerId);

    /**
     * @param swoole_server $server
     * @param $fd
     * @param $reactor_id
     * @param $data
     * @return mixed
     */
    abstract protected function receive(swoole_server $server, $fd, $reactor_id, $data);

}