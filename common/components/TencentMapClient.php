<?php
namespace common\components;

use common\components\Common\InstanceTrait;
use GuzzleHttp\Client as GuzzleClient;
use Yii;

class TencentMapClient
{
    use InstanceTrait;

    public $key;
    public $client;

    public function __construct()
    {
        $this->key = Yii::$app->params['TENCENT_MAP_KEY'];
        // $this->client =
        $this->client = new GuzzleClient([
            'base_uri' => 'http://apis.map.qq.com/ws/place/v1/',
            'timeout' => 5.0,
        ]);
    }

    public function suggestion($city, $keyword)
    {
        $city = urlencode($city);
        $keyword = urlencode($keyword);

        $api = 'suggestion/?region=' . $city . '&keyword=' . $keyword . '&key=' . $this->key;

        $res = $this->client->get($api)->getBody()->getContents();
        return json_decode($res, true);
    }
}