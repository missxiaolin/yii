<?php
namespace console\controllers\Cs\test;

use EasyWeChat\BasicService\Application;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use Yii;

class WechatController extends Controller
{
    /**
     * 初始化
     */
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        echo 'Help:' . PHP_EOL;
        echo '微信脚本' . PHP_EOL;

        echo 'Usage:' . PHP_EOL;
        echo './yii Cs/test/wechat [action]' . PHP_EOL;

        echo 'Actions:' . PHP_EOL;

        echo 'tempSms               小程序模板消息' . PHP_EOL;
    }

    /**
     * 发送模板消息
     */
    public function actionTempSms()
    {
        $config = Yii::$app->params['easywechat'];
        $app = new Application($config);
        $mini_program = $app->mini_program;
        $res = $mini_program->notice->send([
            'touser' => 'or34b0XiHnOv2cnqvIgovXDxUjkc',
            'template_id' => 'b8oScGlt4Ou8SdWeTlz8BBlsRpSd1xcXjpPIpRPwDYA',
            'url' => 'xxxxx',
            'form_id' => 'FORMID',
            'data' => [
                'keyword1' => '工作汇报',
                'keyword2' => '多日没有收到订单',
                'keyword3' => '5条',
            ],
        ]);

        print_r($res);
    }
}