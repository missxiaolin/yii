<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->params['meta_title'] ?? '') ?></title>
    <meta name="Keywords" content="<?= Html::encode($this->params['meta_keyword'] ?? '') ?>"/>
    <meta name="Description" content="<?= Html::encode($this->params['meta_description'] ?? '') ?>"/>
    <meta name="X-CSRF-TOKEN" content="">
    <link rel="stylesheet" href="/www/css/app.css">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="app">
    <?php if (empty(Yii::$app->user->isGuest)) { ?>
        <div class="header">
            <?= $this->render('../partials/header'); ?>
        </div>
    <?php } ?>
    <?php if (empty(Yii::$app->user->isGuest)) { ?>
        <div class="content">

            <div class="sidenav">
                <?= $this->render('../partials/sidenav'); ?>
            </div>


            <div class="main-content">
                <div class="shell-content">
                    <?= $content ?>
                </div>
            </div>
        </div>
    <?php }else{ ?>
        <?= $content ?>
    <?php } ?>
    <?php if (empty(Yii::$app->user->isGuest)) { ?>
        <div class="footer">
            <?= $this->render('../partials/footer'); ?>
        </div>
    <?php } ?>
</div>
<script src="/www/js/app.js"></script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
