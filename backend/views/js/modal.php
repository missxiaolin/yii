<?php
use \backend\assets\AppAsset;

AppAsset::addCss($this, '@web/www/css/js/modal.css');

AppAsset::addScript($this, '@web/www/js/js/modal.js');
//AppAsset::addScript($this, '@web/www/lib/bootstrap-notify/bootstrap-notify.js');

?>

<a style="width: 100px" href="javascript:;" class="btn btn-primary btn-block" >模态框</a>
