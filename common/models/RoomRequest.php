<?php

namespace common\models;

use Yii;
use common\models\Room;

/**
 * This is the base model class for table "room_request".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $privilege
 * @property integer $room_id
 * @property integer $docs_received
 * @property string $entry_year
 * @property string $exclusion_year
 *
 * @property \common\models\Payment[] $payments
 * @property \common\models\Room $room
 * @property \common\models\User $user
 */
class RoomRequest extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'entry_year', 'exclusion_year'], 'required'],
            [['user_id', 'privilege', 'room_id', 'docs_received'], 'integer'],
            ['privilege', 'default', 'value' =>'0'],
            ['docs_received', 'default', 'value' =>'0'],
            [['entry_year', 'exclusion_year'], 'safe']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_request';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'Користувач'),
            'privilege' => Yii::t('app', 'Привілеї'),
            'room_id' => Yii::t('app', 'Кімната'),
            'docs_received' => Yii::t('app', 'Документи отримані'),
            'entry_year' => Yii::t('app', 'Початок проживання'),
            'exclusion_year' => Yii::t('app', 'Закінчення проживання'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(\common\models\Payment::className(), ['room_request_id' => 'id']);
    }
	
    public function getPayment()
    {
		$payment = \common\models\Payment::find()->where(['=', 'room_request_id', $this->id])->andWhere(['<', 'paid_before', 'NOW()'])->one();
        return $payment;
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(\common\models\Room::className(), ['id' => 'room_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
    }
	
	public function afterDelete()
	{
		if (!parent::afterDelete()) {
			return false;
		}

		if ($room = Room::findOne($this->room_id)) {
			if($count = $this->find()->where(['room_id' => $this->room_id])->count()) {
				$room->living = $count;
				if ($room->save())
					return true;
			}
		}
		
		return false;
	}
	
	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);

		if ($room = Room::findOne($this->room_id)) {
			if($count = $this->find()->where(['room_id' => $this->room_id])->count()) {
				$room->living = $count;
				if ($room->save()) {
					return true;
				}
			}
		}
		return false;
	}
	
    public function loadAll($args)
    {
		return RoomRequest::findAll($args);
    }
}
