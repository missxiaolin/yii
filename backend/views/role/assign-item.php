<?php
use yii\helpers\Html;
use \backend\assets\AppAsset;

AppAsset::addCss($this, '@web/www/css/role/assign-item.css');

AppAsset::addScript($this, '@web/www/js/role/assign-item.js');
?>
<div class="wrap-content">
    <div id="contain">
        <p class="top-title">分配权限</p>
        <form id="form" onsubmit="return false">
            <div class="row">
                <div class="small-8 columns">
                    <label>角色名称: <?= $parent ?? '' ?></label>
                </div>
                <div class="small-14 columns columns">

                </div>
            </div>
        </form>
    </div>
</div>