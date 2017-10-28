<?php
use \backend\assets\AppAsset;

AppAsset::addCss($this, '@web/www/css/js/cookie.css');

AppAsset::addScript($this, '@web/www/js/js/cookie.js');

?>

<p>设置cookie: </p>
<p>cookie.set(key, 值)</p>
<p>cookie.set('name', 'value', { expires: 7 });</p>
<p>cookie.set('name', 'value', { expires: 7, path: '' });</p>
<p>cookie.set('name', 'value', { domain: 'xiaolin.com' });</p>
<br>

<p>获取cookie: </p>
<p>cookie.get(key)</p>
<br>

<p>删除cookie: </p>
<p>cookie.remove(key)</p>
<br>

<p>获取所有cookie: cookie.get()</p>
<p>cookie.get()</p>
<br>

