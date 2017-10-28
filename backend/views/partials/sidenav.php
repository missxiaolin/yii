<?php
$url_name = Yii::$app->controller->route;
$nav = Yii::$app->params['leftNav'];
?>
<ul class="nav nav-pills nav-stacked">
    <?php foreach ($nav as $key => $item) { ?>
        <li role="presentation" data-id="<?= $key ?>">
            <a href="#">
                <span class="caret towards-right"></span><?= $item['presentation'] ?? '' ?>
            </a>
            <ul class="nav sidebar-trans active">
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