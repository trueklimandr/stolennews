<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $news common\models\News */

$this->title = "Редактируем новость № $news->id: \"$news->title\"";
?>

<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'news' => $news,
    ]) ?>

</div>
