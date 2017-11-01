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
    /**
     * @param string $route
     * @param string $modmeth
     * @param string $url
     * @return \Yar_Client
     */
    public function api($route = '', $modmeth = '', $url = 'http://www.assets.com/')
    {
        return new \Yar_Client("{$url}{$route}");
    }
}