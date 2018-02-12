<?php

use yii\helpers\BaseUrl;
use yii\helpers\Html;

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
                <?php for ($i = 0; $i <= count($news)-1; $i++) {?>
                    <?php if ($i%2 == 0) echo '<div class="row">'?>
                <div class="col-lg-6">
                <div class="col-lg-12">
                    <div class="row">
                        <h3><a class="news-link" href='<?= $news[$i]->url?>'><?= $news[$i]->title?></a></h3>
                        <h4 class="text-info"><?= '&#171;'. $news[$i]->rubric .'&#187;'?></h4>
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="<?= $news[$i]->imgpath?>" class="img-responsive" alt="News image">
                            </div>
                            <div class="col-lg-8">
                                <p><?= $news[$i]->body?></p>
                            </div>
                        </div>

                        <?= Html::a('Редактировать', ['create'], ['class' => 'btn btn-success']) ?>

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
