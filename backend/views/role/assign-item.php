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
                        <label>角色名称：</label>
                    </div>
                    <div class="small-14 columns columns" style="padding-top: 7px;">
                        <?= $parent ?? '' ?>
                        <input type="hidden" name="name" value="<?= $parent ?? '' ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="small-8 columns">
                        <label for="right-label" class="text-right">角色子节点：</label>
                    </div>
                    <div class="small-14 columns" style="padding-top: 7px;">
                        <?php foreach ($roles ?? [] as $key => $role) { ?>
                            <div class="permission">
                                <input name="children[]" id="" type="checkbox"
                                       value="<?= $key ?>"
                                />
                                <label for=""><?= $role ?></label>
                            </div>
                        <?php } ?>
                    </div>

                </div>

                <div class="row">
                    <div class="small-8 columns">
                        <label for="right-label" class="text-right">角色子节点：</label>
                    </div>
                    <div class="small-14 columns" style="padding-top: 7px;">
                        <?php foreach ($permissions ?? [] as $key => $permission) { ?>
                            <div class="permission">
                                <input name="children[]" id="" type="checkbox"
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
                    <input type="hidden" name="id" value="<?= $id ?? 0 ?>">
                    <input type="submit" class="button save" value="保存">
                    <a class="button clone" href="javascript:history.back()">取消</a>
                </div>
            </form>
        </div>
    </div>

<?= $this->render('../common/success-pop'); ?>
<?= $this->render('../common/loading-pop'); ?>
<?= $this->render('../common/prompt-pop', ['type' => 1]); ?>