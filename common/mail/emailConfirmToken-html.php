<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/confirm', 'id' => $user->id, 'key' => $user->auth_key]);
?>
<div class="password-reset">
    <p>Доброго дня, <?= Html::encode($user->username) ?>,</p>

    <p>Для завершення реєстрації перейдіть за посиланням:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
