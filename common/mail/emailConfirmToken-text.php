<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/confirm', 'id' => $user->id, 'key' => $user->auth_key]);
?>
Доброго дня, <?= $user->username ?>,

Для завершення реєстрації перейдіть за посиланням:

<?= $resetLink ?>
