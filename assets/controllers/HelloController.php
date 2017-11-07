<?php
namespace assets\controllers;

use common\components\thrift\services\HelloHandler;
use Xin\Thrift\HelloThrift\HelloServiceProcessor;
use Thrift\Transport\TBufferedTransport;
use Thrift\Protocol\TBinaryProtocol;
use Thrift\Transport\TPhpStream;
use yii\console\Controller;
use Yii;

class HelloController extends Controller
{
    // 测试
    public function actionIndex()
    {
        header('Content-Type','application/x-thrift');
        if (php_sapi_name() == 'cli') {
            echo PHP_EOL;
        }
        $handler = new HelloHandler();
        $processor = new HelloServiceProcessor($handler);
        $transport = new TBufferedTransport(new TPhpStream(TPhpStream::MODE_R | TPhpStream::MODE_W));
        $protocol = new TBinaryProtocol($transport,true,true);
        $transport->open();
        $processor->process($protocol,$protocol);
        $transport->close();
    }

}