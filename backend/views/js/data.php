<?php
use \backend\assets\AppAsset;

AppAsset::addCss($this, '@web/www/css/js/data.css');

AppAsset::addScript($this, '@web/www/js/js/data.js');
?>
<p>日期选择</p>
<input type="text" class="form-control1">

<p>日期与时间</p>
<input type="text" class="form-control2">

<p>区间时间</p>
Start <input type="text" class="date_timepicker_start" value="">
End <input type="text" class="date_timepicker_end" value="">

<p>时间选择</p>
<input type="text" class="form-control3"">

<br>
<p>更多使用：</p>
<a style="width: 100px" href="https://xdsoft.net/jqplugins/datetimepicker/" class="btn btn-primary btn-block" target="_blank">参考文档</a>
