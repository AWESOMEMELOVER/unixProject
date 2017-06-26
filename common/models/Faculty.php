<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faculty".
 *
 * @property integer $id
 * @property string $title
 * @property string $contact_info
 *
 * @property Speciality[] $specialities
 */
class Faculty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faculty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'contact_info'], 'required'],
            [['contact_info'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Назва',
            'contact_info' => 'Контактна інформація',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialities()
    {
        return $this->hasMany(Speciality::className(), ['faculty_id' => 'id']);
    }
	
    public function loadAll($args)
    {
		return Faculty::findAll($args);
    }
}
