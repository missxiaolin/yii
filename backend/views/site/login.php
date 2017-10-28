<?php
use \backend\assets\AppAsset;

AppAsset::addCss($this, '@web/www/css/site/login.css');

AppAsset::addScript($this, '@web/www/js/site/login.js');

?>
<div class="login-box">
    <div class="login-box-body">
        <form id="form" method="POST" onsubmit="return false">
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="帐号"
                       value=""
                       data-validation="required length"
                       data-validation-length="max20"
                       data-validation-error-msg="请输入帐号"/>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="密码"
                       value=""
                       data-validation="required length"
                       data-validation-length="20"
                       data-validation-error-msg="请输入密码"/>
            </div>
            <button type="submit" class="btn btn-primary btn-block">登录</button>
        </form>
    </div>
</div>

<?= $this->render('../common/success-pop', ['title' => '登录成功']); ?>
<?= $this->render('../common/loading-pop'); ?>
<?= $this->render('../common/prompt-pop', ['type' => 1]); ?>
