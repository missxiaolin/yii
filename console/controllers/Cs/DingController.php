<?php
namespace console\controllers\Cs;

use yii\console\Controller;
use Yii;

class DingController extends Controller
{
    /**
     * 接口文档（https://open-doc.dingtalk.com/docs/doc.htm?spm=a219a.7629140.0.0.karFPe&treeId=257&articleId=105735&docType=1）
     * 钉钉机器人
     * https://oapi.dingtalk.com/robot/send?access_token=09fc591d1e369e228de645e59385b981081088fc5f20f0ed91510753c74981e0
     */
    public function actionTest()
    {
        $token = '09fc591d1e369e228de645e59385b981081088fc5f20f0ed91510753c74981e0';
        $url = 'https://oapi.dingtalk.com/robot/send?access_token=' . $token;
        $post = [
            'msgtype' => 'text',
            'text' => [
                'content' => '测试'
            ],
            'at' => [
                'isAtAll' => true
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=utf-8'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        dump($data);
        curl_close($ch);
    }

}