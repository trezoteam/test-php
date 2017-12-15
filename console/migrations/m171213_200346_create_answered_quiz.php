<?php

use yii\db\Migration;

class m171213_200346_create_answered_quiz extends Migration
{
    public function safeUp()
    {
        $this->createTable('answered_quiz', [
            'id' => $this->primaryKey(),
            'start_at' => $this->timestamp()->notNull(),
            'finish_at' => $this->timestamp(),
            'quiz_id' => $this->integer()->notNull(),
            'web_user_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('answered_quiz_quiz_id_fkey', 'answered_quiz', 'quiz_id',
            'quiz', 'id');
        $this->addForeignKey('answered_quiz_web_user_id_fkey', 'answered_quiz', 'web_user_id',
            'web_user', 'id');
    }

    public function safeDown()
    {
        $this->dropForeignKey('answered_quiz_quiz_id_fkey', 'answered_quiz');
        $this->dropForeignKey('answered_quiz_web_user_id_fkey', 'answered_quiz');
        $this->dropTable('answered_quiz');
    }
}
