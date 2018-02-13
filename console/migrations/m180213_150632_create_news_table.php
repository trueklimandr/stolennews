<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m180213_150632_create_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('news', [
            'id' => $this->integer(11),
            'url' => $this->text(),
            'rubric' => $this->string(30),
            'title' => $this->string(200),
            'imgpath' => $this->string(200),
            'body' => $this->text(),
            'time' => $this->time(),
            'date' => $this->date(),
            'PRIMARY KEY(id)',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('news');
    }
}
