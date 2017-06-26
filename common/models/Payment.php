<?php

namespace common\models;

use Yii;

/**
 * This is the base model class for table "payment".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $is_privat
 * @property integer $payed
 * @property integer $room_request_id
 * @property string $timestamp
 * @property string $paid_before
 *
 * @property \common\models\RoomRequest $roomRequest
 * @property \common\models\User $user
 */
class Payment extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'is_privat', 'room_request_id'], 'required'],
            [['user_id', 'is_privat', 'payed', 'room_request_id'], 'integer'],
            [['timestamp', 'paid_before'], 'safe']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'Користувач'),
            'is_privat' => Yii::t('app', 'Онлайн-оплата'),
            'payed' => Yii::t('app', 'Оплачено'),
            'room_request_id' => Yii::t('app', 'Поселення'),
            'timestamp' => Yii::t('app', 'Дата і час'),
            'paid_before' => Yii::t('app', 'Оплачено до'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomRequest()
    {
        return $this->hasOne(\common\models\RoomRequest::className(), ['id' => 'room_request_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
    }
	
    public function loadAll($args)
    {
		return Payment::findAll($args);
    }
}