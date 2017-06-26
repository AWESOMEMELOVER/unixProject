<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Адмін-панель ГУРТОК',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
		['label' => 'Факультети',  
			'url' => ['/admin/faculty/'],
			'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
			'items' => [
				['label' => 'Факультети', 'url' => '/admin/faculty/'],
				['label' => 'Спеціальності', 'url' => '/admin/speciality/'],
			],
		],
		['label' => 'Гуртожитки',  
			'url' => ['/admin/dormitory/'],
			'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
			'items' => [
				['label' => 'Гуртожитки', 'url' => '/admin/dormitory/'],
				['label' => 'Кімнати', 'url' => '/admin/room/'],
			],
		],
		['label' => 'Користувачі',  
			'url' => ['/admin/user/'],
			'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
			'items' => [
				['label' => 'Користувачі', 'url' => '/admin/user/'],
				['label' => 'Навчання', 'url' => '/admin/study/'],
				['label' => 'Поселення', 'url' => '/admin/room-request/'],
				['label' => 'Оплати', 'url' => '/admin/payment/'],
			],
		],
        ['label' => 'Сайт', 'url' => '/'],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
