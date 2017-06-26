<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1>Код помилки: <?= Html::encode($this->title) ?></h1>

    <p>Текст помилки:</p>
    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
		Під час обробки вашого запиту трапилася помилка.
    </p>
    <p>
        Будь ласка, зв'яжіться з нами за допомогою <?= Html::a('форми зворотнього зв\'язку', ['contact', 'error_subject' => $this->title, 'error_text' => $message, 'error_url' => \Yii::$app->request->pathInfo, 'error_get' => http_build_query(\Yii::$app->request->get()), 'error_post' => http_build_query(\Yii::$app->request->post())], ['target' => '_blank']) ?>, вказав і якщо ви вважаєте, що це помилка сервера. Дякую.
    </p>

</div>
