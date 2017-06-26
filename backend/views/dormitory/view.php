<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Dormitory */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dormitory'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dormitory-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'Dormitory').' '. Html::encode($this->title) ?></h2>
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
        'address',
        'longitude',
        'latitude',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerBulletinBoard->totalCount){
    $gridColumnBulletinBoard = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'user.username',
                'label' => Yii::t('app', 'User')
            ],
            'timestamp',
            'is_active',
            'title',
            'description:ntext',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerBulletinBoard,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-bulletin-board']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Bulletin Board')),
        ],
        'export' => false,
        'columns' => $gridColumnBulletinBoard
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerNews->totalCount){
    $gridColumnNews = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'timestamp',
            'title',
            'text:ntext',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerNews,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-news']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'News')),
        ],
        'export' => false,
        'columns' => $gridColumnNews
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerRoom->totalCount){
    $gridColumnRoom = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'number',
            'floor',
            'places',
            'living',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerRoom,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-room']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Room')),
        ],
        'export' => false,
        'columns' => $gridColumnRoom
    ]);
}
?>
    </div>
</div>
