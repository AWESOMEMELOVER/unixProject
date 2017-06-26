<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Study */

$this->title = Yii::t('app', 'Create Study');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Study'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="study-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
