<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $timestamp
 * @property string $title
 * @property string $text
 * @property integer $is_readed
 *
 * @property User $user
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'text'], 'required'],
            [['user_id', 'is_readed'], 'integer'],
            [['timestamp'], 'safe'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
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
            'user_id' => 'Користувач',
            'timestamp' => 'Дата і час',
            'title' => 'Title',
            'text' => 'Text',
            'is_readed' => 'Is Readed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
