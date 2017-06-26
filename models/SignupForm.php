<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use common\models\Import;
use common\models\Study;
use common\models\Faculty;
use common\models\Speciality;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $code;
    public $email;
    public $password;
    public $password_repeat;
	
	public function attributeLabels()
	{
		return [
			'email' => 'Email адреса',
			'password' => 'Пароль',
			'password_repeat' => 'Повторно введіть пароль'
		];
	}


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['code', 'trim'],
            ['code', 'required'],
            ['code', 'exist', 'targetClass' => '\common\models\Import', 'targetAttribute' => 'Id_PersonRequest'],			
			
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'На цю email адресу вже є зареєстрований користувач.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
			['password_repeat', 'required'],
			['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=> 'Паролі не збігаються.']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
		$preloaded = Import::find()->where(['Id_PersonRequest' => $this->code])->one();
		$speciality = Speciality::find()->where(['title' => $preloaded->SpecSpecialityName, 'is_master' => ($preloaded->Id_Qualification  - 1)])->one();
		
		if (!$this->validate() || !$preloaded || !$speciality) {
            return null;
        }
        
        $user = new User();
        $user->username = $preloaded->FIO;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
		$user->status = 0; 
		
        $study = new Study();
        if (!$user->save()) {
			return null;
		} else {
			$study->user_id = $user->id;
			$study->import_id = $this->code;
			$study->speciality_id = $speciality->id;
			$study->entry_year = date('Y-09-01');
			$study->exclusion_year = date('Y-09-01', strtotime('+5 years'));
			if ($study->save()) {
				return $user;
			} else {
				return null;
			}
		}
    }
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne(['email' => $this->email]);

        return \Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailConfirmToken-html', 'text' => 'emailConfirmToken-text'],
                ['user' => $user]
            )
            ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Завершення реєстрації на ' . \Yii::$app->name)
            ->send();
    }
}
