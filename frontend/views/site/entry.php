<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name')->label('Ваше имя') ?>

<?= $form->field($model, 'email')->label('Ваш e-mail') ?>

<?= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), [  ])->label('Введите символы с картинки:') ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

