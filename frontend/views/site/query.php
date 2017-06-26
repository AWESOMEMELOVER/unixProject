<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
$this->title = 'Запити';
?>
<div class="site-index">

    <div class="jumbotron">
        <h3>Запит: <?= $query ?></h3>
		<?php if($is_parametric): ?>
		<?php $form = BaseHtml::beginForm(['method' => 'post']); ?>
<?= BaseHtml::input(['rows' => 6, name='KOMENTAR'])->label(false) ?>
<div class="form-group">
    <?= Html::submitButton('POST', ['class' => 'btn btn-primary']) ?>
</div>
<?php BaseHtml::endForm() ?>
		<?php endif; ?>
		<? if (Yii::$app->user->isGuest): ?>
        <p class="lead">Для роботи в системі необхідно <?= Html::a('авторизуватися', ['login']) ?>, або <?= Html::a('зареєструватись', ['signup']) ?>.</p>
		<? endif; ?>
    </div>
</div>
