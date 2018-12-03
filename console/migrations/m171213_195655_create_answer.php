<?php

use yii\db\Migration;

class m171213_195655_create_answer extends Migration
{
    public function safeUp()
    {
        $this->createTable('answer', [
            'id' => $this->primaryKey(),
            'answer' => $this->string(255)->notNull(),
            'is_correct' => $this->boolean()->notNull(),
            'created_at' => $this->timestamp()->notNull(),
            'updated_at' => $this->timestamp()->notNull(),
            'question_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('answer_question_id_fkey', 'answer', 'question_id',
            'question', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('answer_question_id_fkey', 'answer');
        $this->dropTable('answer');
    }
}
