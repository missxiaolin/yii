<?php

use \backend\assets\AppAsset;

AppAsset::addCss($this, '@web/www/css/user/assign.css');

AppAsset::addScript($this, '@web/www/js/user/assign.js');

?>

<div class="wrap-content">
    <div id="contain">
        <p class="top-title">授权</p>
        <form id="form" onsubmit="return false">
            <div class="row">
                <div class="small-8 columns">
                    <label>用户名称：</label>
                </div>
                <div class="small-14 columns columns" style="padding-top: 7px;">
                    <?= $admin_model->username ?? '' ?>
                    <input type="hidden" name="id" value="<?= $admin_model->id ?? 0 ?>">
                </div>
            </div>

            <div class="row">
                <div class="small-8 columns">
                    <label for="right-label" class="text-right">角色：</label>
                </div>
                <div class="small-14 columns" style="padding-top: 7px;">
                    <?php foreach ($roles ?? [] as $key => $role) { ?>
                        <div class="permission">
                            <input name="children[]" id=""
                                   type="checkbox"
                                   <?php if (in_array($key, $children['roles'] ?? [])) { ?>checked<?php } ?>
                                   value="<?= $key ?>"
                            />
                            <label for=""><?= $role ?></label>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="row">
                <div class="small-8 columns">
                    <label for="right-label" class="text-right">权限：</label>
                </div>
                <div class="small-14 columns" style="padding-top: 7px;">
                    <?php foreach ($permissions ?? [] as $key => $permission) { ?>
                        <div class="permission">
                            <input name="children[]" id="" type="checkbox"
                                   <?php if (in_array($key, $children['permissions'] ?? [])) { ?>checked<?php } ?>
                                   value="<?= $key ?>"
                            />
                            <label for=""><?= $permission ?></label>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="small-8 columns">
                    <label for="right-label" class="text-right"></label>
                </div>
                <p class="error-tip-permissions error-tip" style="display: none;">请选择至少1个角色权限</p>
            </div>

            <div class="text-center">
                <input type="submit" class="button save" value="保存">
                <a class="button clone" href="javascript:history.back()">取消</a>
            </div>
        </form>
    </div>
</div>

<?= $this->render('../common/success-pop'); ?>
<?= $this->render('../common/loading-pop'); ?>
<?= $this->render('../common/prompt-pop', ['type' => 1]); ?>
