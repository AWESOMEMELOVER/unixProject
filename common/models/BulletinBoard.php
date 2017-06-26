<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bulletin_board".
 *
 * @property integer $id
 * @property integer $dormitory_id
 * @property integer $user_id
 * @property string $timestamp
 * @property integer $is_active
 * @property string $title
 * @property string $description
 *
 * @property Dormitory $dormitory
 * @property User $user
 */
class BulletinBoard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bulletin_board';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dormitory_id', 'user_id', 'is_active', 'title', 'description'], 'required'],
            [['dormitory_id', 'user_id', 'is_active'], 'integer'],
            [['timestamp'], 'safe'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['dormitory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dormitory::className(), 'targetAttribute' => ['dormitory_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'Користувач',
            'timestamp' => 'Дата і час',
            'is_active' => 'Активне',
            'title' => 'Назва',
            'description' => 'Опис',
        ];
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
	
    public function loadAll($args)
    {
		return BulletinBoard::findAll($args);
    }
}
