<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статус поселення';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-request-index">

    <h1><?= Html::encode($this->title) ?></h1>
	<? if($user->roomRequest): ?>
		<? if($user->roomRequest->room_id): ?>
		<h3>Ви поселенні в кімнаті <?= $user->roomRequest->room->number; ?> гуртожитку за адресою <?= $user->roomRequest->room->dormitory->address; ?></h3>
			<? if(!$user->roomRequest->docs_received): ?>
			<h4>УВАГА! Необхідно принести заяву на поселення - <?= Html::a('роздрукувати', ['print']) ?>.</h4>
			<? endif; ?>
			<? if(!$user->roomRequest->payment): ?>
			<h4>УВАГА! Ви не заплатили за проживання у гуртожитку - <?= Html::a('оплатити в Приват24', \yii\helpers\Url::to('https://www.liqpay.com/ru/checkout/card/380937939454', true)) ?>.</h4>
			<? endif; ?>
		<? else: ?>
		<h3>Ви в черзі на поселення</h3>
		<? endif; ?>
	<? else: ?>
		<h3>У вас немає заяв на поселення</h3>
		<p><?= Html::a('Створити заяву на поселення', ['me-add'], ['class' => 'btn btn-success']) ?></p>
	<? endif; ?>
	
</div>