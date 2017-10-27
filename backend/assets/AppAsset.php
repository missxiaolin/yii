<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
    ];
    public $depends = [
    ];

    /**
     * 加载js
     * @param $view
     * @param $js_file
     */
    public static function addScript($view, $js_file)
    {
        $view->registerJsFile($js_file);
    }

    /**
     * @param $view
     * @param $css_file
     */
    public static function addCss($view,$css_file)
    {
        $view->registerCssFile($css_file);
    }
}
