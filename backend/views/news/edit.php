<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $news common\models\News */

$this->title = 'Update Country: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $news->name, 'url' => ['view', 'id' => $news->code]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'news' => $news,
    ]) ?>

</div>
