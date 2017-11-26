<?php

use \backend\assets\AppAsset;

AppAsset::addCss($this, '@web/www/css/role/edit.css');

AppAsset::addScript($this, '@web/www/js/role/edit.js');

?>

<div class="wrap-content">
    <div id="contain">
        <?php if (!$id) { ?>
            <p class="top-title">角色添加</p>
        <?php } else { ?>
            <p class="top-title">角色编辑</p>
        <?php } ?>
        <form id="form" onsubmit="return false">
            <div class="content-box">
                <div class="row">
                    <div class="small-8 columns">
                        <label for="right-label" class="text-right">标识：</label>
                    </div>
                    <div class="small-14 columns">
                        <input type="text" name="name" value=""
                               data-validation="required length"
                               data-validation-error-msg="请输入标识">
                    </div>
                </div>

                <div class="row">
                    <div class="small-8 columns">
                        <label for="right-label" class="text-right">名称：</label>
                    </div>
                    <div class="small-14 columns">
                        <input type="text" name="description" value=""
                               data-validation="required length"
                               data-validation-error-msg="请输入名称">
                    </div>
                </div>

                <div class="row">
                    <div class="small-8 columns">
                        <label for="right-label" class="text-right">规则：</label>
                    </div>
                    <div class="small-14 columns">
                        <input type="text" name="rule_name" value="">
                    </div>
                </div>

                <div class="row">
                    <div class="small-8 columns">
                        <label for="right-label" class="text-right">数据：</label>
                    </div>
                    <div class="small-14 columns">
                        <textarea name="data" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>

            </div>

            <div class="text-center">
                <input type="hidden" name="id" value="<?= $id ?? 0 ?>">
                <input type="submit" class="button save" value="保存">
                <a class="button clone" href="javascript:history.back()">取消</a>
            </div>
        </form>
    </div>
</div>
