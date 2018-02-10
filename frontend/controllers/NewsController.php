<?php

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\News;

class NewsController extends Controller
{
    /**
     * Стартовое действие: загружает новости из БД.
     * Если в БД нет данных, сначала наполняет её.
     */
    public function actionIndex()
    {
        $news = News::find()->orderBy('id')->all();
        if (count($news)==0) {
            $this->saveNews($this->stealNews($this->getUrlsOfNews()));
        }
        $news = News::find()->orderBy('id')->all();
        return $this->render('index', ['news' => $news]);
    }
    /**
     * Сохранение новостей из яндекса в БД.
     * @param $data array - данные для заполнения, полученные методом stealNews()
     * @throws \Exception | \Throwable in case saveNews failed.
     */
    public function saveNews($data)
    {
        for ($i = 1; $i <= count($data); $i++) {
            $news = new News();
            $news->id = $data[$i]['id'];
            $news->url = $data[$i]['url'];
            $news->rubric = $data[$i]['rubric'];
            $news->title = $data[$i]['title'];
            $news->imgpath = $data[$i]['imgpath'];
            $news->body = $data[$i]['body'];
            $news->time = $data[$i]['time'];
            $news->date = $data[$i]['date'];
            $news->save();
        }
    }
    /**
     * Получаем указанное количество ссылок на новости (одна ссылка - одна новость)
     * По умолчанию - 10
     */
    public function getUrlsOfNews(
        $countofnews = 10,
        $url = 'https://news.yandex.ru/',
        $pref = 'https://news.yandex.ru/yandsearch',
        $pattern = '|href="/yandsearch(.*?)"|',
        $waste = 'amp;',
        $options = [
            CURLOPT_COOKIE => 'yandexuid=2325996121515220506; _ym_uid=1516169224315701609; mda=0; L=ZA5KBQN5W2AAXEBhRQx4f'.
                'khxeXNbe3hBEjwdHAUpBiwlJSE4.1516169281.13381.323616.07aa9db1e1752c1de28a04ace657bb71; i=K9iJWf2N5oj3HD8F'.
                'j1oJea2uUmNt5eqC0V3SrrLrmEpXV3+V+Y0Kp4xl5UWvFLz+lDrWbegWWdJlYK7s8OBP6vP8Lbs=; yandex_gid=42; my=YwA=; fu'.
                'id01=5a6c826666ad5b4b.S_iVdXJrlEbB1rc5rk2sqEWhl91zOpgRQkiDCvQ9j3R00EfoM1mRVnF5HqoX48O2NW9WVdUNWQdBtI8za5'.
                'Ykv3BUxYh3IdC80SjqBxO4YyXxADbfVLwQCLBPregSo4Rr; yabs-frequency=/4/0000000000000000/PU5GS2Wk8G00/; zm=m-w'.
                'hite_404.webp.css%3A2.1521%3Al; yp=1830580506.yrts.1515220506#1519652710.ygu.1#1518270310.ysl.1#15248367'.
                '11.ww.1#1532829760.szm.1_00%3A1920x1080%3A1855x990#1519739324.csc.2#1519654356.shlos.1#1548598356.los.0#'.
                '1833193203.multib.1; ys=wprid.1517062355749054-595434840388347205567524-sas1-1326-p1#ymrefl.3F493327C717'.
                '5B6A; device_id="bd999492c3e4bc335e61e9a356dca1edf5fd3d8e1"; _ym_isad=2; _ym_visorc_722818=b',
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_AUTOREFERER => true,
            CURLOPT_REFERER => 'https://news.yandex.ru/',
            CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.119 Safari/537.36',
            CURLOPT_RETURNTRANSFER => true
        ]
    ) {
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $content = str_replace($waste, '', curl_exec($ch));
        curl_close($ch);

        preg_match_all($pattern, $content,$matches);
        $urls = array_slice($matches[1], 0, $countofnews);
        for ($i = 0; $i <= ($countofnews-1); $i++) {
            $urls[$i] = $pref . $urls[$i];
        }
        return $urls;
    }
    /**
     * Парсим новости в массив по указанным ссылкам (по умолчанию 10 штук)
     */
    public function stealNews(
        $urls,
        $patterns = [
            'rubric' => '|rubric-label__dot"\>\<\/div\>(.*?)\<|',
            'title' => '|story__head"\>(.*?)\<|',
            'imgpath' => '|class="image"\ssrc="(.*?)"|',
            'body' => '|doc__text"\>(.*?)\<|',
            'time' => '|(\d\d:\d\d),|'
        ],
        $options = [
            CURLOPT_BINARYTRANSFER => false,
            CURLOPT_COOKIE => 'yandexuid=2325996121515220506; _ym_uid=1516169224315701609; mda=0; L=ZA5KBQN5W2AAXEBhRQx4f'.
                'khxeXNbe3hBEjwdHAUpBiwlJSE4.1516169281.13381.323616.07aa9db1e1752c1de28a04ace657bb71; i=K9iJWf2N5oj3HD8F'.
                'j1oJea2uUmNt5eqC0V3SrrLrmEpXV3+V+Y0Kp4xl5UWvFLz+lDrWbegWWdJlYK7s8OBP6vP8Lbs=; yandex_gid=42; my=YwA=; fu'.
                'id01=5a6c826666ad5b4b.S_iVdXJrlEbB1rc5rk2sqEWhl91zOpgRQkiDCvQ9j3R00EfoM1mRVnF5HqoX48O2NW9WVdUNWQdBtI8za5'.
                'Ykv3BUxYh3IdC80SjqBxO4YyXxADbfVLwQCLBPregSo4Rr; yabs-frequency=/4/0000000000000000/PU5GS2Wk8G00/; zm=m-w'.
                'hite_404.webp.css%3A2.1521%3Al; yp=1830580506.yrts.1515220506#1519652710.ygu.1#1518270310.ysl.1#15248367'.
                '11.ww.1#1532829760.szm.1_00%3A1920x1080%3A1855x990#1519739324.csc.2#1519654356.shlos.1#1548598356.los.0#'.
                '1833193203.multib.1; ys=wprid.1517062355749054-595434840388347205567524-sas1-1326-p1#ymrefl.3F493327C717'.
                '5B6A; device_id="bd999492c3e4bc335e61e9a356dca1edf5fd3d8e1"; _ym_isad=2; _ym_visorc_722818=b',
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_AUTOREFERER => true,
            CURLOPT_REFERER => 'https://news.yandex.ru/',
            CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.119 Safari/537.36',
            CURLOPT_RETURNTRANSFER => true
        ]
    ) {
        for ($i = 0; $i <= (count($urls)-1); $i++) {
            $c = $i + 1;

            //echo '.';//чтобы в окне вывода видеть прогресс (иногда зависает)

            $ch = curl_init($urls[$i]);
            curl_setopt_array($ch, $options);
            $content = curl_exec($ch);
            curl_close($ch);

            $newsarray[$c]['id'] = $c;
            $newsarray[$c]["url"] = $urls[$i];

            preg_match($patterns['rubric'], $content, $matches);
            $newsarray[$c]["rubric"] = $matches[1];

            preg_match($patterns['title'], $content, $matches);
            $newsarray[$c]["title"] = $matches[1];

            if (preg_match($patterns['imgpath'], $content, $matches)) {
                $newsarray[$c]["imgpath"] = $matches[1];
            } else {
                $newsarray[$c]["imgpath"] = 'No image';
            }

            preg_match($patterns['body'], $content, $matches);
            $newsarray[$c]["body"] = $matches[1];

            preg_match_all($patterns['time'], $content, $matches);
            $newsarray[$c]["time"] = $matches[1][1];

            $newsarray[$c]["date"] = date("ymd");
        }
        return $newsarray;
    }
}
