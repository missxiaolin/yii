<?php
namespace app\modules\v1\controllers;

use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\THttpClient;
use Thrift\Transport\TBufferedTransport;
use Xin\Thrift\HelloThrift\HelloServiceClient;
use Yii;

class RpcController extends BaseController
{
    /**
     * RPC（测试用）
     * @return array
     */
    public function actionIndex()
    {
        try {
            $socket = new THttpClient('www.assets.com', 80, '/hello/index');
            $transport = new TBufferedTransport($socket, 1024, 1024);
            $protocol = new TBinaryProtocol($transport);
            $client = new HelloServiceClient($protocol);

            $transport->open();

            echo $client->sayHello(" World! ");

            $transport->close();
        } catch (\Exception $e) {
            print 'TException:' . $e->getMessage() . PHP_EOL;
        }
    }
}