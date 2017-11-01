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

    public function all($route = '', $method = '', $param = ['user'=>4,3])
    {
        \Yar_Concurrent_Client::call($this->url . $route, $method, $param, [$this, 'ApiClientCallBack']);
        \Yar_Concurrent_Client::loop();
    }

    public function ApiClientCallBack($retval, $callinfo)
    {
        dump($retval);
        dump($callinfo);
//        if($callinfo === null){
//            return $this->callBack($retval,$callinfo);
//        }
//        static $data = array();
//        $data[$callinfo['method']] = $retval;
//        if(count($data) == $this->callNum){
//            $fn = $this->callBack;
//            return $fn($data,$callinfo);
//        }
    }
}