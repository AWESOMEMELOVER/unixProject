<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заяви на поселення';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-request-index">

    <h1><?= Html::encode($this->title) ?> <small>(<?=($all ? '' : '<u>') . Html::a('Очікуючі на поселення', ['list']) . ($all ? '' : '</u>')?> / <?= ($all ? ' <u>' : '') . Html::a('Усі', ['list', 'all' => '1']) . ($all ? '</u>' : '') ?>)</small></h1>

    <p>
        <?= Html::a('Вивантажити данні', ['export'], ['class' => 'btn btn-success']) ?> 
    </p>
	
    <?
	$widgetConfig = [
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
			'user.username',
			'user.studytitle',
            //'privilege'
			
		]
	];
	if (!$all) {
		$widgetConfig['columns'][] = [
			'class' => 'yii\grid\ActionColumn',
			'template'=>'{approve}',
			'buttons'=>[
				'approve' => function ($url, $model) use($rooms) { 
					$html = \yii\helpers\Html::beginForm('approve', 'GET');				
					$html .= \kartik\widgets\Select2::widget([
						'name' => 'room_id',
						'value' => '',
						'data' => \yii\helpers\ArrayHelper::map($rooms, 'id', 'title'),
						'options' => ['placeholder' => 'Виберіть гуртожиток та кімнату']
					]);	
					$html .= \yii\helpers\Html::hiddenInput('id', $model->id);	
					$html .= Html::submitButton('Поселити', ['class' => 'btn btn-link', 'title' => Yii::t('yii', 'Поселити')]);
					$html .= yii\helpers\Html::endForm();	
					return $html;                                
				}
			]
		];
	} else {
		$widgetConfig['columns'][] = 'room_id';
		$widgetConfig['columns'][] = 'docs_received';
	}
	echo GridView::widget($widgetConfig); ?>
</div>