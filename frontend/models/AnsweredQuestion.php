<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "answered_question".
 *
 * @property integer $id
 * @property string $answer
 * @property integer $question_id
 * @property integer $answered_quiz_id
 *
 * @property AnsweredQuiz $answeredQuiz
 * @property Question $answeredQuiz0
 */
class AnsweredQuestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answered_question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['answer', 'question_id', 'answered_quiz_id'], 'required'],
            [['question_id', 'answered_quiz_id'], 'integer'],
            [['answer'], 'string', 'max' => 255],
            [['answered_quiz_id'], 'exist', 'skipOnError' => true, 'targetClass' => AnsweredQuiz::className(), 'targetAttribute' => ['answered_quiz_id' => 'id']],
            [['answered_quiz_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['answered_quiz_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'answer' => 'Resposta',
            'question_id' => 'Question ID',
            'answered_quiz_id' => 'Answered Quiz ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnsweredQuiz()
    {
        return $this->hasOne(AnsweredQuiz::className(), ['id' => 'answered_quiz_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnsweredQuiz0()
    {
        return $this->hasOne(Question::className(), ['id' => 'answered_quiz_id']);
    }
}
