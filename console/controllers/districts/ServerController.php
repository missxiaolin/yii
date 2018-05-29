<?php

namespace console\controllers\districts;

use common\components\Service\BasicService;
use common\components\Service\HanderInterface;
use common\components\Train;
use swoole_server;
use Exception;

class ServerController extends RpcServer
{

    /**
     * host
     * @var string
     */
    protected $host = '0.0.0.0';

    /**
     * 端口号
     * @var int
     */
    protected $port = '11520';

    /**
     * 配置项
     * @var array
     */
    protected $config = [
        'pid_file' => './socket.pid',
        'daemonize' => false,
        'max_request' => 500, // 每个worker进程最大处理请求次数
        'worker_num' => 1,
    ];

    /**
     * @var array
     */
    public $services = [];

    public function init()
    {
        // 开启服务时，读取样本学习
        $classifier = Train::getInstance()->classifier;
        $this->setHandler('test',BasicService::getInstance());
        parent::init(); // TODO: Change the autogenerated stub
    }

    /**
     * @param $service
     * @param HanderInterface $hander
     * @return $this
     */
    public function setHandler($service, HanderInterface $hander)
    {
        $this->services[$service] = $hander;
        return $this;
    }

    /**
     * @param swoole_server $server
     * @param $workerId
     */
    public function workerStart(swoole_server $server, $workerId)
    {
        // TODO: Implement workerStart() method.
    }

    /**
     * @param swoole_server $server
     * @param $fd
     * @param $reactor_id
     * @param $data
     */
    public function receive(swoole_server $server, $fd, $reactor_id, $data)
    {
        // TODO: Implement receive() method.
        try {
            $data = json_decode($data, true);
            $service = $data['service'];
            $method = $data['method'];
            $arguments = $data['arguments'];

            if (!isset($this->services[$service])) {
                throw new Exception("The service handler is not exist!");
            }

            $result = $this->services[$service]->$method(...$arguments);
            $server->send($fd, $this->success($result));
        } catch (\Exception $ex) {
            $server->send($fd, $this->fail($ex->getCode(), $ex->getMessage()));
        }
    }
}