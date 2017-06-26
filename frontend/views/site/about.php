<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Інформація';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Житловий відділ - +38 (044) 462 49 44</p>
	<? foreach($faculties as $faculty): ?>
	<p><?= nl2br('<b>' . Html::encode($faculty->title . PHP_EOL) . '</b>' . Html::encode($faculty->contact_info . PHP_EOL)); ?></p>
	<? endforeach; ?>
</div>
