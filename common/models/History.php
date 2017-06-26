<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "history".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $timestamp
 * @property string $action
 *
 * @property User $user
 */
class History extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'action'], 'required'],
            [['user_id'], 'integer'],
            [['timestamp'], 'safe'],
            [['action'], 'string', 'max' => 255],
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
            'action' => 'Дія',
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
