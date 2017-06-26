<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Yii::t('app', 'User').' '. Html::encode($this->title) ?></h2>
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
        'username',
        'auth_key',
        'password_hash',
        'password_reset_token',
        'email:email',
        'status',
        'type',
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
                'attribute' => 'dormitory.id',
                'label' => Yii::t('app', 'Dormitory')
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
if($providerHistory->totalCount){
    $gridColumnHistory = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'timestamp',
            'action',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerHistory,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-history']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'History')),
        ],
        'export' => false,
        'columns' => $gridColumnHistory
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerNotification->totalCount){
    $gridColumnNotification = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'timestamp',
            'title',
            'text:ntext',
            'is_readed',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerNotification,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-notification']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Notification')),
        ],
        'export' => false,
        'columns' => $gridColumnNotification
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerPayment->totalCount){
    $gridColumnPayment = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'is_privat',
            'payed',
            [
                'attribute' => 'roomRequest.id',
                'label' => Yii::t('app', 'Room Request')
            ],
            'timestamp',
            'paid_before',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerPayment,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-payment']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Payment')),
        ],
        'export' => false,
        'columns' => $gridColumnPayment
    ]);
}
?>
    </div>
    
    <div class="row">
<?php
if($providerRoomRequest->totalCount){
    $gridColumnRoomRequest = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        'privilege',
            [
                'attribute' => 'room.id',
                'label' => Yii::t('app', 'Room')
            ],
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
    
    <div class="row">
<?php
if($providerStudy->totalCount){
    $gridColumnStudy = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
                        [
                'attribute' => 'speciality.title',
                'label' => Yii::t('app', 'Speciality')
            ],
            'import_id',
            'entry_year',
            'exclusion_year',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerStudy,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-study']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode(Yii::t('app', 'Study')),
        ],
        'export' => false,
        'columns' => $gridColumnStudy
    ]);
}
?>
    </div>
</div>
