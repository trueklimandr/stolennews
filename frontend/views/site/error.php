<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Указанная ошибка возникла во время обработки Вашего запроса.
    </p>
    <p>
        Пожалуйста, свяжитесь с нами, если считатете, что ошибка на нашем сервере. Спасибо.
    </p>

</div>
