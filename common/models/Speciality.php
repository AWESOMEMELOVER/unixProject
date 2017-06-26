<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "speciality".
 *
 * @property integer $id
 * @property integer $faculty_id
 * @property string $title
 * @property integer $is_master
 *
 * @property Faculty $faculty
 * @property Study[] $studies
 */
class Speciality extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'speciality';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faculty_id', 'title'], 'required'],
            [['faculty_id', 'is_master'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['faculty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faculty::className(), 'targetAttribute' => ['faculty_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'faculty_id' => 'Факультет',
            'title' => 'Назва',
            'is_master' => 'Магістерська программа',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty()
    {
        return $this->hasOne(Faculty::className(), ['id' => 'faculty_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudies()
    {
        return $this->hasMany(Study::className(), ['speciality_id' => 'id']);
    }
	
    public function loadAll($args)
    {
		return Speciality::findAll($args);
    }
}
