<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dormitory".
 *
 * @property integer $id
 * @property string $address
 * @property string $longitude
 * @property string $latitude
 *
 * @property BulletinBoard[] $bulletinBoards
 * @property News[] $news
 * @property Room[] $rooms
 */
class Dormitory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dormitory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address', 'longitude', 'latitude'], 'required'],
            [['address'], 'string', 'max' => 255],
            [['longitude', 'latitude'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Адреса',
            'longitude' => 'Довжина',
            'latitude' => 'Ширина',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBulletinBoards()
    {
        return $this->hasMany(BulletinBoard::className(), ['dormitory_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['dormitory_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Room::className(), ['dormitory_id' => 'id']);
    }
	
    public function loadAll($args)
    {
		return Dormitory::findAll($args);
    }
}
