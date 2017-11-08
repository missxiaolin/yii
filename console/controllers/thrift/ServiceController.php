<?php
namespace console\controllers\thrift;

use common\components\thrift\clients\RegisterClient;
use common\components\thrift\services\AppHandler;
use console\controllers\dope\Socket;
use console\controllers\utils\Input;
use console\controllers\utils\Sign;
use console\controllers\utils\Str;
use Thrift\Protocol\TBinaryProtocol;
use Thrift\TMultiplexedProcessor;
use Thrift\Transport\TMemoryBuffer;
use Xin\Thrift\MicroService\AppProcessor;
use Xin\Thrift\Register\ServiceInfo;
use swoole_server;
use swoole_process;
use Yii;

class ServiceController extends Socket
{
    protected $config = [
        'pid_file' => __DIR__ . '/service.pid',
        'daemonize' => false,
        // 'worker_num' => 4, // cpu核数1-4倍比较合理 不写则为cpu核数
        'max_request' => 500, // 每个worker进程最大处理请求次数
    ];

    protected $port = 10086;

    protected $host = '127.0.0.1';

    protected $processor;

    /**
     * @return array
     */
    protected function events()
    {
        return [
            'receive' => [$this, 'receive'],
            'WorkerStart' => [$this, 'workerStart'],
        ];
    }

    /**
     * @desc   服务注册
     * @author limx
     * @param swoole_server $server
     * @param               $name
     */
    protected function registryHeartbeat(swoole_server $server, $name)
    {
        $worker = new swoole_process(function (swoole_process $worker) use ($name) {
            $config = Yii::$app->params['thrift'];
            $client = RegisterClient::getInstance([
                'host' => $config->register->host,
                'port' => $config->register->port,
            ]);
            swoole_timer_tick(5000, function () use ($client, $name, $config) {
                $service = new ServiceInfo();
                $service->name = $name;
                $service->host = $this->host;
                $service->port = $this->port;
                $service->nonce = Str::random(16);
                $service->isService = true;
                $service->sign = Sign::sign(Sign::serviceInfoToArray($service));

                $result = $client->heartbeat($service);

                if ($result->success === false) {
                    Yii::info($result->message);
                    return;
                }

                if (!isset($result->services)) {
                    Yii::info("服务列表为空！");
                    return;
                }

                foreach ($result->services as $key => $item) {
                    $serviceJson = json_encode(Sign::serviceInfoToArray($item));
                    Yii::info($serviceJson);
                    $redis = Yii::$app->redis;
                    $redis->hset($config->service->listKey, $key, $serviceJson);
                }
            });


        });
        $server->addProcess($worker);
    }

    /**
     * @param swoole_server $server
     */
    protected function beforeServerStart(swoole_server $server)
    {
        parent::beforeServerStart($server);
        $isOpen = Yii::$app->params['thrift']['register']['open'];
        if ($isOpen) {
            $this->registryHeartbeat($server, 'app');
        }
    }

    /**
     * @param swoole_server $serv
     * @param $workerId
     */
    public function workerStart(swoole_server $serv, $workerId)
    {
        // dump(get_included_files()); // 查看不能被平滑重启的文件

        $this->processor = new TMultiplexedProcessor();
        $handler = new AppHandler();
        $this->processor->registerProcessor('app', new AppProcessor($handler));
    }

    /**
     * @param swoole_server $server
     * @param $fd
     * @param $reactor_id
     * @param $data
     */
    public function receive(swoole_server $server, $fd, $reactor_id, $data)
    {
        $transport = new TMemoryBuffer($data);
        $protocol = new TBinaryProtocol($transport);
        $transport->open();
        $this->processor->process($protocol, $protocol);
        $server->send($fd, $transport->getBuffer());
        $transport->close();
    }

}