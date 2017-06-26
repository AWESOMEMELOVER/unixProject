<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
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
        'brandLabel' => 'ГУРТОК',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Головна', 'url' => ['/site/index']],
        ['label' => 'Інформація', 'url' => ['/site/about']],
        ['label' => 'Зворотній зв\'язок', 'url' => ['/site/contact']],
		/*['label' => 'Складні запити',  
			'url' => ['#'],
			'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
			'items' => [
				['label' => 'На 3 таблиці', 'url' => ['query', 'id' => '1']],
				['label' => 'З групуванням 1', 'url' => ['query', 'id' => '2']],
				['label' => 'З групуванням 2', 'url' => ['query', 'id' => '3']],
				['label' => 'З групуванням 3', 'url' => ['query', 'id' => '4']],
				['label' => 'З групуванням 4', 'url' => ['query', 'id' => '5']],
				['label' => 'З подвійним запереченням', 'url' => ['query', 'id' => '6']],
			],
		],
		['label' => 'Параметричні запити',  
			'url' => ['#'],
			'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
			'items' => [
				['label' => 'Запит 1', 'url' => ['query', 'id' => '7']],
				['label' => 'Запит 2', 'url' => ['query', 'id' => '8']],
			],
		],
		['label' => 'Параметричні запити',  
			'url' => ['#'],
			'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
			'items' => [
				['label' => 'Запит 1', 'url' => ['query', 'id' => '9']],
				['label' => 'Запит 2', 'url' => ['query', 'id' => '10']],
				['label' => 'Запит 3', 'url' => ['query', 'id' => '11']],
				['label' => 'Запит 4', 'url' => ['query', 'id' => '12']],
				['label' => 'Запит 5', 'url' => ['query', 'id' => '13']],
				['label' => 'Запит 6', 'url' => ['query', 'id' => '14']],
				['label' => 'Запит 7', 'url' => ['query', 'id' => '15']],
				['label' => 'Запит 8', 'url' => ['query', 'id' => '16']],
				['label' => 'Запит 9', 'url' => ['query', 'id' => '17']],
				['label' => 'Запит 10', 'url' => ['query', 'id' => '18']],
			],
		],*/
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Реєстрація', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Авторизація', 'url' => ['/site/login']];
    } else {
#        $menuItems[] = ['label' => 'Новини', 'url' => ['/site/news']];
		if (Yii::$app->user->identity->isModerator()) {
			$menuItems[] = ['label' => 'Заяви на поселення', 'url' => ['/site/list']];
		}
		if (Yii::$app->user->identity->isStudent()) {
			$menuItems[] = ['label' => 'Статус поселення', 'url' => ['/site/my']];
		}
		
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Вихід (' . Yii::$app->user->identity->username . ')',
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
        <p class="pull-right">&copy; Бабич Трохим Анатолійович <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
