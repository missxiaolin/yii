<?php
$url_name = Yii::$app->controller->route;
$nav = Yii::$app->params['leftNav'];
$cookie_nav = Yii::$app->request->cookies->get('nav', []);
$nav_cookie = $get_cookie = $cookie_nav ? json_decode($cookie_nav->value, true) : [];
?>
<ul class="nav nav-pills nav-stacked">
    <?php foreach ($nav as $key => $item) { ?>
        <li role="presentation" data-id="<?= $key ?>">
            <a href="javascript:;">
                <span class="caret <?php if (!in_array($key, $nav_cookie)) { ?>towards-right<?php } ?>"></span><?= $item['presentation'] ?? '' ?>
            </a>
            <ul class="nav sidebar-trans <?php if (!in_array($key, $nav_cookie)) { ?>active<?php } ?>">
                <?php foreach ($item['sidebar_trans'] ?? [] as $submenu_key => $submenu) { ?>
                    <li <?php if ($url_name == $submenu['route']){ ?>class="active"<?php } ?> >
                        <a href="<?= route($submenu['route']) ?>">
                            <i class="iconfont"><?= $submenu['icon'] ?? '' ?></i><?= $submenu['name'] ?? '' ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
</ul>