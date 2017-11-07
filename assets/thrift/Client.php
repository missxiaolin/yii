<?php
namespace assets\thrift;

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Protocol\TMultiplexedProtocol;
use Thrift\Transport\TBufferedTransport;
use Thrift\Transport\TSocket;

abstract class Client implements ClientInterface
{
    /**
     * @var array
     */
    public static $_instance = [];

    /**
     * @var array
     */
    public static $_protocol = [];

    /**
     * @var mixed
     */
    protected $host;

    /**
     * 端口号
     * @var mixed
     */
    protected $port;

    /**
     * @var
     */
    protected $service;

    /**
     * @var
     */
    protected $clientName;

    /**
     * @var
     */
    protected $client;

    /**
     * @var bool
     */
    protected $persist = false;

    /**
     * @var null
     */
    protected $debugHandler = null;

    /**
     * @var int
     */
    protected $rBufSize = 512;

    /**
     * @var int
     */
    protected $wBufSize = 512;

    /**
     * @var
     */
    protected $recvTimeoutMilliseconds;

    /**
     * @var
     */
    protected $sendTimeoutMilliseconds;

    /**
     * Client constructor.
     * @param $className
     * @param array $config
     * @throws ClientException
     */
    private function __construct($className, $config = [])
    {
        if (isset($config['host'])) {
            $this->host = $config['host'];
        }

        if (isset($config['port'])) {
            $this->port = $config['port'];
        }

        if (!isset($this->host)) {
            throw new ClientException('Thrift Client host is required!');
        }

        if (!isset($this->port)) {
            throw new ClientException('Thrift Client port is required!');
        }

        if (!isset($this->service)) {
            throw new ClientException('Thrift Client service is required!');
        }

        if (!isset($this->clientName)) {
            throw new ClientException('Thrift Client Name is required!');
        }

        $key = $this->host . ':' . $this->port;
        if (empty(static::$_protocol[$key]) || !(static::$_protocol[$key] instanceof TBinaryProtocol)) {

            $socket = new TSocket($this->host, $this->port, $this->persist, $this->debugHandler);

            if (isset($this->recvTimeoutMilliseconds)) {
                // 如果接收超时设置大于0就调用设置接收超时函数设置接收超时
                $socket->setRecvTimeout($this->recvTimeoutMilliseconds);
            }

            if (isset($this->sendTimeoutMilliseconds)) {
                // 如果发生超时设置大于0就调用设置发送超时函数设置发送超时
                $socket->setSendTimeout($this->sendTimeoutMilliseconds);
            }

            $transport = new TBufferedTransport($socket, $this->rBufSize, $this->wBufSize);
            $protocol = new TBinaryProtocol($transport);

            static::$_protocol[$key] = $protocol;

            $transport->open();
        }

        $protocol = new TMultiplexedProtocol(static::$_protocol[$key], $this->service);

        $class = $this->clientName;
        $this->client = new $class($protocol);

    }

    /**
     * @param array $config
     * @return mixed|static
     */
    public static function getInstance($config = [])
    {
        $class = get_called_class();
        if (isset(static::$_instance[$class]) && static::$_instance[$class] instanceof ClientInterface) {
            return static::$_instance[$class];
        }
        return static::$_instance[$class] = new static($class, $config);
    }

    /**
     * @return bool
     */
    public function flush()
    {
        $class = get_called_class();
        static::$_instance[$class] = null;
        return true;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        $obj = static::getInstance();
        return $obj->client->$name(...$arguments);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->client->$name(...$arguments);
    }
}