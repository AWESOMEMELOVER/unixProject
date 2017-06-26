<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "study".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $speciality_id
 * @property integer $import_id
 * @property string $entry_year
 * @property string $exclusion_year
 *
 * @property Speciality $speciality
 * @property User $user
 */
class Study extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'study';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'speciality_id', 'import_id', 'entry_year'], 'required'],
            [['user_id', 'speciality_id', 'import_id'], 'integer'],
            [['entry_year', 'exclusion_year'], 'safe'],
            [['speciality_id'], 'exist', 'skipOnError' => true, 'targetClass' => Speciality::className(), 'targetAttribute' => ['speciality_id' => 'id']],
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
            'speciality_id' => 'Спеціальність',
            'import_id' => 'Номер заяви',
            'entry_year' => 'Рік вступу',
            'exclusion_year' => 'Рік закінчення',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpeciality()
    {
        return $this->hasOne(Speciality::className(), ['id' => 'speciality_id']);
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
		return Study::findAll($args);
    }
}
