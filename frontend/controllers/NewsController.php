<?php

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\News;

class NewsController extends Controller
{
    public function actionIndex()
    {
        $news = News::find()->orderBy('id')->all();
        //return var_dump($news);
        return $this->render('index', ['news' => $news]);
    }
}
