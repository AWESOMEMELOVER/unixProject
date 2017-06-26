<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RoomRequest */

$this->title = Yii::t('app', 'Create Room Request');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Room Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
