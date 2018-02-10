<?php

$this->title = (Yii::$app->name).'.Новости';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="row text-danger">
                <h1 class="text-center"><?= Yii::$app->i18n->messageFormatter->format(
                        '{count, number} {count, plural, one{лучшая самая свежая интересная новость.} '.
                        'few{лучших самых свежих интересных новости.} other{лучших самых свежих интересных новостей.}}',
                        ['count' => count($news)],
                        Yii::$app->language
                    );
                    ?> <small> От Яндекса.</small></h1>
            </div>
                <?php for ($i = 0; $i <= count($news)-1; $i++) {?>

                <div class="col-lg-6">
                    <div class="row">
                        <h3><a style="color:black; font-weight: bold" href='<?= $news[$i]->url?>'><?= $news[$i]->title?></a></h3>
                        <h4 class="text-info"><?= '&#171;'. $news[$i]->rubric .'&#187;'?></h4>
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="<?= $news[$i]->imgpath?>" class="img-responsive" alt="Responsive image">
                            </div>
                            <div class="col-lg-8">
                                <p><?= $news[$i]->body?></p>
                                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Docum &raquo;</a></p>
                            </div>
                        </div>
                    </div>
                </div>

            <?php }?>
        </div>
    </div>
</div>
