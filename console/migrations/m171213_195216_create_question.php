<?php

use yii\db\Migration;

class m171213_195216_create_question extends Migration
{
    public function safeUp()
    {
        $this->createTable('question', [
            'id' => $this->primaryKey(),
            'subject' => $this->string(255)->notNull(),
            'type' => $this->boolean()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
            'quiz_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('question_quiz_id_fkey', 'question', 'quiz_id',
            'quiz', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('question_quiz_id_fkey', 'question');
        $this->dropTable('question');
    }
}
