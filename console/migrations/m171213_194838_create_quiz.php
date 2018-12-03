<?php

use yii\db\Migration;

class m171213_194838_create_quiz extends Migration
{
    public function safeUp()
    {
        $this->createTable('quiz', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('quiz');
    }
}
