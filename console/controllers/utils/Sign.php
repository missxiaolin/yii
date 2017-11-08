<?php
namespace console\controllers\utils;

use Xin\Thrift\Register\ServiceInfo;
use Yii;

class Sign
{
    /**
     * @param array $input
     * @return string
     */
    public static function sign($input = [])
    {
        $config = Yii::$app->params['thrift']['register'];
        unset($input['sign']);
        ksort($input);
        $data = http_build_query($input);

        return md5(md5($data) . $config->key);
    }

    /**
     * @param $input
     * @param $sign
     * @return bool
     */
    public static function verify($input, $sign)
    {
        $isVerify = Yii::$app->params['thrift']['register']['signVerify'];
        if ($isVerify) {

            unset($input['sign']);
            return static::sign($input) === $sign;
        }

        return true;
    }

    /**
     * @param ServiceInfo $serviceInfo
     * @return array
     */
    public static function serviceInfoToArray(ServiceInfo $serviceInfo)
    {
        return [
            'name' => $serviceInfo->name,
            'host' => $serviceInfo->host,
            'port' => $serviceInfo->port,
            'nonce' => $serviceInfo->nonce,
            'sign' => $serviceInfo->sign,
            'isService' => $serviceInfo->isService,
        ];
    }
}