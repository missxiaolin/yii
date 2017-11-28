<?php

use \backend\assets\AppAsset;

AppAsset::addCss($this, '@web/www/css/admin/index.css');

AppAsset::addScript($this, '@web/www/js/admin/index.js');

?>

<div class="wrapper-box">
    <div id="contain">
        <div class="filter-box">
            <div class="add">
                <a href="<?= route('role/create-role', ['id' => 0]) ?>" class="button add-btn">+角色</a>
            </div>
        </div>
        <div class="table-box">
            <table class="table" cellspacing="0" cellpadding="0">
                <thead>
                <tr>
                    <th>管理员ID</th>
                    <th>管理员账号</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($models ?? [] as $model) { ?>
                    <tr>
                        <td>
                            <?= $model->id ?? '' ?>
                        </td>
                        <td>
                            <?= $model->username ?? '' ?>
                        </td>
                        <td>
                            <?= $model->created_at ?? '' ?>
                        </td>
                        <td>
                            <a class="icon-edit" title="分配角色"
                               href="">
                                <i class="iconfont">&#xe602;</i>
                            </a>
                            <a class="icon-edit" title="编辑" href="">
                                <i class="iconfont">&#xe609;</i>
                            </a>
                            <a data-id="" title="删除" class="delete">
                                <i class="iconfont">&#xe749;</i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php if (!empty($pagers)) { ?>
            <div class="patials-paging">
                <?= \yii\widgets\LinkPager::widget(['pagination' => $pagers]); ?>
            </div>
        <?php } ?>
    </div>
</div>

<?= $this->render('../common/prompt-pop', ['type' => 1]); ?>
<?= $this->render('../common/confirm-pop', ['type' => 2, 'confirm_text' => "这条数据"]); ?>
