<?php
namespace console\controllers\Cs;

use common\components\thrift\clients\AppClient;
use console\controllers\utils\Curl;
use yii\console\Controller;

class RequestController extends Controller
{
    public $yiiUrl = 'http://www.xiaolinapi.com/v1/user/index';
    // 测试yii http 和 rpc性能
    public function actionIndex()
    {
        $count = 100;

        $btime = microtime(true);
        for ($i = 0; $i < $count; $i++) {
            $yiiRequest = Curl::json($this->yiiUrl,'GET');
        }
        $etime = microtime(true);
        dump('Yii HTTP处理时间为:' . ($etime - $btime));

        $btime = microtime(true);
        $client = AppClient::getInstance();

        for ($i = 0; $i < $count; $i++) {
            $client->version();
        }
        $etime = microtime(true);
        dump('Thrift.Rpc处理时间为:' . ($etime - $btime));
    }
}