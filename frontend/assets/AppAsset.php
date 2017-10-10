<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public static $params = [];

    public $css = [

    ];
    public $js = [

    ];
    public $depends = [

    ];

    public static function addParams($params)
    {
        self::$params = \yii\helpers\ArrayHelper::merge(self::$params, $params);
    }

    public static function getParams()
    {
        return self::$params;
    }
}
