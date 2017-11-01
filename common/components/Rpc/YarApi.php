<?php
namespace common\components\Rpc;

use Yii;
use Exception;

/**
 * Yar rpc client
 *
 * @author xiaolin
 * @return void
 * @date: 2017-10-31
 *
 */
class YarApi
{

    private $url = 'http://www.assets.com/';

    /**
     * @param string $route
     * @param string $method
     * @param $param
     * @return \Yar_Client
     */
    public function api($route = '', $method = '', $param = [])
    {
        try {
            $url = $this->url . $route;
            $client = new \Yar_Client($url);
            return $client->$method($param);
        } catch (Exception $e) {
            Yii::info($e->getMessage());
        }

    }

    /**
     * @param string $route
     * @param string $method
     * @param array $param
     * @return mixed
     */
    public function all($route = '', $method = '', $param = [])
    {
        try {
            return \Yar_Concurrent_Client::call($this->url . $route, $method, $param, [$this, 'ApiClientCallBack']);
        } catch (Exception $e) {
            Yii::info($e->getMessage());
        }
    }

    /**
     * 执行
     */
    public function loop()
    {
        \Yar_Concurrent_Client::loop();
    }

    /**
     * @param $retval
     * @param $callinfo
     * @return bool
     */
    public function ApiClientCallBack($retval, $callinfo)
    {
        if (empty($callinfo)) {
            return false;
        }
        return $callinfo;
    }
}