<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property integer $dormitory_id
 * @property string $timestamp
 * @property string $title
 * @property string $text
 *
 * @property Dormitory $dormitory
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dormitory_id'], 'integer'],
            [['timestamp'], 'safe'],
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['dormitory_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dormitory::className(), 'targetAttribute' => ['dormitory_id' => 'id']],
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
            'timestamp' => 'Дата і час',
            'title' => 'Назва',
            'text' => 'Текст',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDormitory()
    {
        return $this->hasOne(Dormitory::className(), ['id' => 'dormitory_id']);
    }
	
    public function loadAll($args)
    {
		return News::findAll($args);
    }
}
