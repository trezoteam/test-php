<?php

use yii\db\Migration;

class m171213_200140_create_web_user extends Migration
{
    public function safeUp()
    {
        $this->createTable('web_user', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'email' => $this->string(255)-> notNull()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('web_user');
    }
}
