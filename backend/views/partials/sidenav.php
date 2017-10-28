<?php
$menus = [
    '小林JS' => [
        'js/data',
    ],
];

$url_nam = Yii::$app->controller->route;
?>
<ul class="nav nav-pills nav-stacked">
    <li role="presentation">
        <a href="#">
            <span class="caret"></span>小林JS</a>
        <ul class="nav sidebar-trans">
            <li <?php if (in_array($url_nam, $menus['小林JS'])){ ?>class="active"<?php } ?> >
                <a href="<?= route('js/data') ?>">
                    <i class="iconfont">&#xe60e;</i>日期与时间
                </a>
            </li>
        </ul>
    </li>
</ul>