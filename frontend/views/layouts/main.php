<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta name="author" content="">
    <meta name="Keywords" content="<?= Html::encode($this->params['meta_keyword'] ?? '') ?>"/>
    <meta name="Description" content="<?= Html::encode($this->params['meta_description'] ?? '') ?>"/>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->params['title'] ?? '小林') ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="top">
    头部
</div>
<div id="container">
    <?= $content ?>
</div>

<footer class="footer">
    底部
</footer>

<?php if (isset($this->params['file_css']) && $this->params['file_css']) { ?>
    <link href="<?= $this->params['host'] ?? '' ?>/<?= $this->params['file_css'] ?>.css?v=<?= time() ?>" rel="stylesheet"/>
<?php } ?>

<script src="<?= $this->params['host'] ?? '' ?>/js/lib/require.js"></script>
<script src="<?= $this->params['host'] ?? '' ?>/js/lib/config.js"></script>
<script>
    require.config({
        <?php if ($this->params['debug']){ ?>
            waitSeconds: 0,
            urlArgs: "v=" + (new Date()).getTime(),
        <?php } ?>
        baseUrl: '<?= $this->params['base_url'] ?>'
    });
    define('page.params', function () {
        return <?= json_encode( \frontend\controllers\Resource::getAllParams()) ?>;
    });
</script>

<?php if (isset($this->params['file_js']) && $this->params['file_js']) { ?>
    <script src="<?= $this->params['host'] ?? '' ?>/<?= $this->params['file_js'] ?>.js?v=<?= time() ?>"></script>
<?php } ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
