<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property integer $id
 * @property integer $dormitory_id
 * @property string $number
 * @property integer $floor
 * @property integer $places
 *
 * @property Dormitory $dormitory
 * @property RoomRequest[] $roomRequests
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dormitory_id', 'number', 'floor', 'places'], 'required'],
            [['dormitory_id', 'floor', 'places'], 'integer'],
            [['number'], 'string', 'max' => 3],
            [['dormitory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dormitory::className(), 'targetAttribute' => ['dormitory_id' => 'id']],
            [['user.username', 'user.study'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dormitory_id' => 'Гуртожиток',
            'number' => 'Номер',
            'floor' => 'Поверх',
            'places' => 'Місць'
        ];
    }
    public function getTitle()
    {
        return $this->dormitory->address . ' - ' . $this->number;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDormitory()
    {
        return $this->hasOne(Dormitory::className(), ['id' => 'dormitory_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoomRequests()
    {
        return $this->hasMany(RoomRequest::className(), ['room_id' => 'id']);
    }
	
    public function loadAll($args)
    {
		if(isset($args['Room'])) $args = $args['Room'];
		return Room::findAll($args);
    }
}
