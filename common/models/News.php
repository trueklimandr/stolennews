<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $url
 * @property string $rubric
 * @property string $title
 * @property string $imgpath
 * @property string $body
 * @property string $time
 * @property string $date
 */
class News extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['url', 'body'], 'string'],
            [['time', 'date'], 'safe'],
            [['rubric'], 'string', 'max' => 30],
            [['title', 'imgpath'], 'string', 'max' => 200],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'rubric' => 'Rubric',
            'title' => 'Title',
            'imgpath' => 'Imgpath',
            'body' => 'Body',
            'time' => 'Time',
            'date' => 'Date',
        ];
    }
}
