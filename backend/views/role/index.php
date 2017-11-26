<?php

use \backend\assets\AppAsset;

AppAsset::addCss($this, '@web/www/css/role/index.css');

AppAsset::addScript($this, '@web/www/js/role/index.js');

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
                    <th width="10%">编号</th>
                    <th width="30%">角色名称</th>
                    <th width="30%">角色权限</th>
                    <th width="10%">操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>id</td>
                    <td>name</td>
                    <td>permission_names</td>
                    <td>
                        <a class="icon-edit" title="编辑" href="">
                            <i class="iconfont">&#xe609;</i>
                        </a>
                        <a data-id="" title="删除" class="delete">
                            <i class="iconfont">&#xe749;</i>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->render('../common/prompt-pop', ['type' => 1]); ?>
<?= $this->render('../common/confirm-pop', ['type' => 2, 'confirm_text' => "这条数据"]); ?>
