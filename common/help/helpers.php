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

