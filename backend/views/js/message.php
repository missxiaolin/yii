<?php
use \backend\assets\AppAsset;

AppAsset::addCss($this, '@web/www/css/js/message.css');

AppAsset::addScript($this, '@web/www/js/js/message.js');

?>

<a style="width: 100px" href="javascript:;" class="btn btn-primary btn-block" >消息框</a>
