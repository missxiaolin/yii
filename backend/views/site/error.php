<?php

use yii\helpers\Html;

$this->title = $name;
?>
<div class="error-right" style="margin-top: 30px;">
    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
</div>