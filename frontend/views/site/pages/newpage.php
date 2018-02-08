<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Carousel;

$this->title = 'Newpage';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::to('',true)]);
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>
</div>
<?= Carousel::widget ( [
    'items' => [
        [
            'content' => '<img style="width:800px" src="//nix-tips.ru/wp-content/uploads/2014/11/carousel003.jpg"/>',
            'caption' => '<h2>Космос<G></G></h2><p>Таинственный и пугающий</p>',
            'options' => []
        ],
        [
            'content' => '<img style="width:800px" src="//nix-tips.ru/wp-content/uploads/2014/11/carousel002.jpg"/>',
            'caption' => '<h2>Отличный отладчик</h2><p>Легко подключается, помнит все запросы http, БД и логи</p>',
            'options' => []
        ],
        [
            'content' => '<img style="width:800px" src="//nix-tips.ru/wp-content/uploads/2014/11/carousel001.jpg"/>',
            'caption' => '<h2>Быстрый старт</h2><p>Установка и обновление через composer</p>',
            'options' => []
        ]
    ],
    'options' => [
        'style' => 'width:800px;' // Задаем ширину контейнера
    ]
]);
?>

