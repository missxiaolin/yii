<?php

if (!function_exists('route')) {
    /**
     * 生成路由
     * @param $url
     * @param array $params
     * @param bool $scheme
     * @return string
     */
    function route($url, $params = [], $scheme = true)
    {
        $urls = $params;
        array_unshift($urls, $url);
        return \yii\helpers\Url::to($urls, $scheme);
    }
}

if (!function_exists('get_value')) {
    /**
     * @param $value
     * @return string
     */
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
            'message' => $msg,
            'time' => (string)time(),
            '_ut' => (string)round(microtime(TRUE) - $_SERVER['REQUEST_TIME_FLOAT'], 5),
        ];

        return $json;
    }
}

