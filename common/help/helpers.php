<?php

if (!function_exists('route')) {
    function route($url, $params = [], $scheme = true)
    {
        $urls = $params;
        array_unshift($urls, $url);
        return \yii\helpers\Url::to($urls, $scheme);
    }
}

if (!function_exists('get_value')) {
    function get_value($value)
    {
        if (isset($value)) {
            return $value;
        } else {
            return '';
        }
    }
}


if (!function_exists('api_response')) {
    /**
     * json 返回
     * @param $data
     * @param string $code
     * @param string $msg
     * @return array
     */
    function api_response($data, $code = '0', $msg = 'ok')
    {
        $json = [
            'data' => $data,
            'code' => $code,
            'msg' => $msg,
            'time' => (string)time(),
            '_ut' => (string)round(microtime(TRUE) - $_SERVER['REQUEST_TIME_FLOAT'], 5),
        ];

        return $json;
    }
}

