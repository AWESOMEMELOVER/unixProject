<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
$this->title = 'Головна';
?>
<div class="site-index">

    <div class="jumbotron">
        <h3>Вітаємо вас, в системі електронного поселення до гуртожитків!</h3>
		<? if (Yii::$app->user->isGuest): ?>
        <p class="lead">Для роботи в системі необхідно <?= Html::a('авторизуватися', ['login']) ?>, або <?= Html::a('зареєструватись', ['signup']) ?>.</p>
		<? endif; ?>
    </div>
</div>
