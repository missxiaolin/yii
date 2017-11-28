<?php

use yii\helpers\Html;

$this->title = $name;
?>
<div class="error-right">
    <h1><?= nl2br(Html::encode($message)) ?></h1>
    <a href="<?= route('site/index') ?>">返回首页</a>
</div>