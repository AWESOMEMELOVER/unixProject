<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Import;
use common\models\Faculty;
use common\models\Room;
use common\models\RoomRequest;
use common\models\RoomRequestSearch;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
		
		if ($subject = Yii::$app->request->get('subject')) {
			switch($subject) {
				case '1':
					$model->subject = 'В системі вказані мої некорректні данні';
					break;
					
				case '2':
					$model->subject = 'Проблеми з підтвердженням адреси електронної пошти';
					break;
			}
		} else {
			if (($error_subject = Yii::$app->request->get('error_subject')) && ($error_text = Yii::$app->request->get('error_text')) && ($error_url = Yii::$app->request->get('error_url'))) {
				$error_get = Yii::$app->request->get('error_get');
				$error_post = Yii::$app->request->get('error_post');
				$model->subject = 'Під час обробки мого запиту трапилася помилка системи';
				$model->body =	'Ваш коментар: ' . PHP_EOL . PHP_EOL . 
								'Код помилки: ' . $error_subject . PHP_EOL .
								'Текст помилки: ' . $error_text . PHP_EOL . PHP_EOL .
								'URL: ' . $error_url . PHP_EOL .
								'GET параметри: ' . $error_get . PHP_EOL .
								'POST параметри: ' . $error_post;
			}
		}
		
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Дякуємо Вам за звернення до нас. Ми відповімо Вам як можна швидше.');
            } else {
                Yii::$app->session->setFlash('error', 'Трапилася помилка при відправці повідомлення.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
		$faculties = Faculty::find()->all();
        return $this->render('about', [
			'faculties' => $faculties
		]);
    }
	
    public function actionList($all = 0)
    {
		$rooms = Room::find()->where(['>', 'living', 'places'])->all();
		
		$search = new RoomRequestSearch();
		$searchParams = Yii::$app->request->getQueryParams();
		$searchParams['all'] = $all;
		$dataProvider = $search->search($searchParams);
		
        return $this->render('list', [
			'all' => $all,
			'dataProvider' => $dataProvider,
			'search' => $search,
			'rooms' => $rooms
		]);
    }
	
    public function actionQuery($id)
    {
		$is_parametric = 0;
		$query = '';
		$data = array();
		switch($id) {
			case '1':
		}
		
        return $this->render('query', [
			'is_parametric' => $is_parametric,
			'query' => $query,
			'data' => $data
		]);
    }
	
    public function actionMeAdd()
    {
		$roomRequest = new RoomRequest;
		$roomRequest->user_id = \Yii::$app->user->identity->id;
		$roomRequest->entry_year = date('Y-m-d');
		$roomRequest->exclusion_year = \Yii::$app->user->identity->study->exclusion_year;
		if ($roomRequest->save()) {
				Yii::$app->session->setFlash('success', 'Створено заяву на поселення.');
		} else {
			Yii::$app->session->setFlash('error', 'Трапилася помилка під час створення заяви на поселення.');
		}
		return $this->redirect('my');
    }
	
    public function actionMy()
    {
        return $this->render('my', [
			'user' => \Yii::$app->user->identity
		]);
    }
	
    public function actionPrint()
    {
		$phpWord = new \PhpOffice\PhpWord\PhpWord();

		$section = $phpWord->addSection();
		$section->addText(
			'Заява на поселення від ' . \Yii::$app->user->identity->username,
			array('name' => 'Tahoma', 'size' => 10)
		);
		
		$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
		header('Content-Disposition: attachment; charset=UTF-8; filename="zayava.docx"');
		$objWriter->save("php://output");
	}
    public function actionApprove($id, $room_id, $all = 0)
    {
		if ($roomRequest = RoomRequest::findOne($id)) {
			$roomRequest->room_id = $room_id;
			if ($roomRequest->save()) {
				Yii::$app->session->setFlash('success', 'Поселено.');
				return $this->redirect('list');
			}
		}
        Yii::$app->session->setFlash('error', 'Трапилася помилка під час поселення.');
		return $this->redirect('list');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     *//*
    public function actionSignup($code)
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }*/

    public function actionSignup()
    {
		$model = new \yii\base\DynamicModel(['code', 'captcha']);
		#var_dump($model);exit;
		
        $model->addRule('code', 'required', ['message' => 'Необхідно заповнити "Номер".']);
		$model->addRule('code', 'string', ['max' => 255]);
		$model->addRule('code', 'exist', [
			'targetClass' => 'common\models\Import',
			'targetAttribute' => 'Id_PersonRequest',
			'skipOnEmpty' => true
		]);
		$model->addRule('code', 'unique', [
			'targetClass' => '\common\models\Study',
			'targetAttribute' => 'import_id',
			'message' => 'По цьому коду вже рееструвались.'
		]);
		$model->attributeLabels(['code' => 'Номер заяви', 'captcha' => 'Код']);
		
		if (isset(Yii::$app->request->post('SignupForm')['code'])) {
			$model->code = Yii::$app->request->post('SignupForm')['code'];
		} else {
			$model->addRule('captcha', 'required', ['message' => 'Необхідно заповнити "Код".']);
			$model->addRule('captcha', 'captcha');
			$model->load(Yii::$app->request->post());
		}
		
		if ($model->code && $model->validate()) {
			$preloaded = Import::find()->where(['Id_PersonRequest' => $model->code])->one();
			$model = new SignupForm();
			if ($model->load(Yii::$app->request->post())) {
				if ($user = $model->signup()) {
					if($model->sendEmail()){
						Yii::$app->getSession()->setFlash('success', 'Для завершення реєстрації необхідно підтвердити електронну адресу, вам відправлено лист з інструкціями.');
					} else {
						Yii::$app->getSession()->setFlash('warning', 'Неможливо відправити листа для підтвердження електронної адреси, зв\'яжіться з нами за допомогою ' . \yii\helpers\Html::a('форми зворотнього зв\'язку', ['contact', 'subject' => '2'], ['target' => '_blank']) . '.');
					}
					return $this->goHome();
				}
			}
			return $this->render('signup', [
				'model' => $model,
				'preloaded' => $preloaded
			]);
		}
		
        return $this->render('import', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
				Yii::$app->getSession()->setFlash('success', 'Перевірте електронну поштову скриньку, вам відправлено лист з інструкціями.');
                return $this->goHome();
            } else {
				Yii::$app->getSession()->setFlash('warning', 'Неможливо відправити листа для нагадування паролю, зв\'яжіться з нами за допомогою ' . \yii\helpers\Html::a('форми зворотнього зв\'язку', ['contact', 'subject' => '3'], ['target' => '_blank']) . '.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
	
	public function actionConfirm($id, $key) {
		$user = \common\models\User::find()->where([
			'id' => $id,
			'auth_key' => $key,
			'status' => 0
		])->one();
		if(!empty($user)){
			$user->status=10;
			$user->save();
			Yii::$app->getSession()->setFlash('success', 'Ви успішно підтвердили електронну адресу.');
		} else{
			Yii::$app->getSession()->setFlash('warning', 'Неможливо підтвердити електронну адресу, зв\'яжіться з нами за допомогою ' . \yii\helpers\Html::a('форми зворотнього зв\'язку', ['contact', 'subject' => '2'], ['target' => '_blank']) . '.');
		}
		return $this->goHome();
	}

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новий пароль збережено.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
