<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Room */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Room'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Room').' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'dormitory.id',
            'label' => Yii::t('app', 'Dormitory'),
        ],
        'number',
        'floor',
        'places',
        'living',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerRoomRequest->totalCount){
    $gridColumnRoomRequest = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            [
                'attribute' => 'user.username',
                'label' => Yii::t('app', 'User')
            ],
            'privilege',
                        'docs_received',
            'entry_year',
            'exclusion_year',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerRoomRequest,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-room-request']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Room Request')),
        ],
        'export' => false,
        'columns' => $gridColumnRoomRequest
    ]);
}
?>
    </div>
</div>
