<?php

use yii\db\Migration;

class m171213_200923_create_answered_question extends Migration
{
    public function safeUp()
    {
        $this->createTable('answered_question', [
            'id' => $this->primaryKey(),
            'answer' => $this->string(255)->notNull(),
            'question_id' => $this->integer()->notNull(),
            'answered_quiz_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('answered_question_question_id_fkey', 'answered_question',
            'question_id', 'question', 'id');
        $this->addForeignKey('answered_question_answered_quiz_id_fkey', 'answered_question',
            'answered_quiz_id', 'answered_quiz', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('answered_question_question_id_fkey', 'answered_question');
        $this->dropForeignKey('answered_question_answered_quiz_id_fkey', 'answered_question');
        $this->dropTable('answered_question');
    }
}
