<?php
namespace common\components\Rpc;

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
        $url = $this->url . $route;
        $client = new \Yar_Client($url);
        return $client->$method($param);
    }
}