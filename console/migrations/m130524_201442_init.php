<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->integer(11)->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->insert('{{%user}}', [
            'username' => 'admin',
            'auth_key' => 'WUJeLLjMSvtqeS6wB6Cvs7Gyru83XmC0',
            'password_hash' => '$2y$13$qRAMTt/Q.hA82FNJAULC.uMib8f7oxH.DJFsEkaxT2M6Ev10XaZlq',
            'password_reset_token' => null,
            'email' => 'admin@mail123.ru',
            'status' => 10,
            'created_at' => 1518347881,
            'updated_at' => 1518347881,
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
