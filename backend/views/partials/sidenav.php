<?php
$url_name = Yii::$app->controller->route;
?>
<ul class="nav nav-pills nav-stacked">
    <li role="presentation">
        <a href="#">
            <span class="caret"></span>小林JS</a>
        <ul class="nav sidebar-trans">
            <li <?php if ($url_name == 'js/data'){ ?>class="active"<?php } ?> >
                <a href="<?= route('js/data') ?>">
                    <i class="iconfont">&#xe60e;</i>日期与时间
                </a>
            </li>
            <li <?php if ($url_name == 'js/cookie'){ ?>class="active"<?php } ?> >
                <a href="<?= route('js/cookie') ?>">
                    <i class="iconfont">&#xe60e;</i>cookie使用
                </a>
            </li>
        </ul>
    </li>
</ul>