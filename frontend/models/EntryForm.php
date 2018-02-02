<?php

namespace frontend\models;

use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $email;
    public $captcha;

    public function rules()
    {
        return [
            [['name', 'email', 'captcha'], 'required'],
            ['email', 'email'],
            ['captcha','captcha'],
        ];
    }
}
