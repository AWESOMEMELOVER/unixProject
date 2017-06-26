<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Реєстрація';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

	<p>Будь ласка, перевірте коректність вказаної інформації:</p>
			
	<div class="row">
		<div class="col-lg-5">
			<div class="form-group">
			<?= Html::label('ПІБ', 'username') ?>
			<?= Html::textInput('username', $preloaded->FIO, ['class' => 'form-control', 'disabled' => true]) ?>
			</div>		
			<div class="form-group">
			<?= Html::label('Факультет', 'faculty') ?>
			<?= Html::textInput('faculty', $preloaded->UniversityFacultetFullName, ['class' => 'form-control', 'disabled' => true]) ?>
			</div>		
			<div class="form-group">
			<?= Html::label('Спеціальність', 'speciality') ?>
			<?= Html::textInput('speciality', $preloaded->SpecSpecialityName, ['class' => 'form-control', 'disabled' => true]) ?>
			</div>		
			<div class="form-group">
			<?= Html::label('Освітньо-кваліфікаційний рівень', 'is_master') ?>
			<?= Html::textInput('is_master', $preloaded->Id_Qualification == 1 ? 'Бакалавр' : 'Магістр', ['class' => 'form-control', 'disabled' => true]) ?>
			</div>
			
		</div>		
	</div>

	<p>У випадку некоректності зв'яжіться з нами за допомогою <?= Html::a('форми зворотнього зв\'язку', ['contact', 'subject' => '1'], ['target' => '_blank']) ?> вказав свій код та яка саме інформація невірно введена.</p>

	<div class="row">
		<div class="col-lg-5">

			<?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
			
					<?= $form->field($model, 'code')->hiddenInput(['value' => $preloaded->Id_PersonRequest])->label(false, ['style'=>'display:none']) ?>

					<?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

					<?= $form->field($model, 'password')->passwordInput() ?>

					<?= $form->field($model, 'password_repeat')->passwordInput() ?>

					<div class="form-group">
						<?= Html::submitButton('Зареєструватись', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
					</div>
					
			<?php ActiveForm::end(); ?>

		</div>
	</div>
</div>