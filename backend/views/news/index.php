<?php

use yii\helpers\BaseUrl;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\News;

$this->title = (Yii::$app->name).'.Новости';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
            <div class="row text-danger">
                <h1 class="text-center"><?= Yii::$app->i18n->messageFormatter->format(
                        '{count, number} {count, plural, one{лучшая самая свежая интересная новость.} '.
                        'few{лучших самых свежих интересных новости.} other{лучших самых свежих интересных новостей.}}',
                        ['count' => count($news)],
                        Yii::$app->language
                    );
                    ?> <small> От Яндекса.</small></h1>
                <p><a class="btn btn-lg btn-success center-block" href="<?= BaseUrl::to(['news/refresh']); ?>
                    ">Загрузить свежайшие новости</a></p>
            </div>

                <?php $news1 = new News(); ?>

                <?php for ($i = 0; $i <= count($news)-1; $i++) {?>
                    <?php if ($i%2 == 0) echo '<div class="row">'?>
                <div class="col-lg-6">
                <div class="col-lg-12">
                    <div class="row">
                        <h3><a class="news-link" href='<?= $news[$i]->url?>'><?= $news[$i]->title?></a></h3>
                        <h4 class="text-info"><?= '&#171;'. $news[$i]->rubric .'&#187;'?></h4>
                        <div class="row">
                            <div class="col-lg-4">
                                <p><img src="<?= $news[$i]->imgpath?>" class="img-responsive" alt="News image"></p>
                                <p>
                                <?php $form_{"$i"} = ActiveForm::begin(); ?>

                                <?= $form_{"$i"}->field($news1, 'id', ['enableLabel' => false])->hiddenInput(['value' => "$i"]) ?>

                                <?= $form_{"$i"}->field($news1, 'url', ['enableLabel' => false])->hiddenInput(['value' => $news[$i]->url]) ?>

                                <?= $form_{"$i"}->field($news1, 'rubric', ['enableLabel' => false])->hiddenInput(['value' => $news[$i]->rubric]) ?>

                                <?= $form_{"$i"}->field($news1, 'title', ['enableLabel' => false])->hiddenInput(['value' => $news[$i]->title]) ?>

                                <?= $form_{"$i"}->field($news1, 'imgpath', ['enableLabel' => false])->hiddenInput(['value' => $news[$i]->imgpath]) ?>

                                <?= $form_{"$i"}->field($news1, 'body', ['enableLabel' => false])->hiddenInput(['value' => $news[$i]->body]) ?>

                                <?= $form_{"$i"}->field($news1, 'time', ['enableLabel' => false])->hiddenInput(['value' => $news[$i]->time]) ?>

                                <?= $form_{"$i"}->field($news1, 'date', ['enableLabel' => false])->hiddenInput(['value' => $news[$i]->date]) ?>

                                <?= Html::submitButton('Редактировать', ['class' => 'btn btn-primary btn-block']) ?>

                                <?php $form_{"$i"} = ActiveForm::end(); ?>
                                </p>
                            </div>
                            <div class="col-lg-8">
                                <p><?= $news[$i]->body?></p>
                            </div>
                        </div>

                        <p class="text-muted">Обновлено в <?= Yii::$app->formatter->asTime($news[$i]->time, 'HH:mm') ?>,
                            (<?= Yii::$app->formatter->asDate($news[$i]->date)?>)</p>
                    </div>
                </div>
                </div>
                    <?php if ($i%2 !== 0) echo '</div>'?>
            <?php }?>
            </div>
        </div>
    </div>
</div>
