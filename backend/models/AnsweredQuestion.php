<?php

namespace backend\models;

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
 * @property Question $question
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
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'answer' => 'Answer',
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
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }

    /**
     * @param $answered_quiz_id int
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function findByAnsweredQuizId($answered_quiz_id)
    {
        return AnsweredQuestion::find()->where(['answered_quiz_id' => $answered_quiz_id])->all();
    }

    /**
     * @param $answered_quiz_id int
     * @return int
     */
    public static function countRigthAnswersByAnsweredQuizId($answered_quiz_id)
    {
        $answered_questions = self::findByAnsweredQuizId($answered_quiz_id);
        $rigth_answers = 0;
        foreach ($answered_questions as $answered_question)
        {
            $answered = Answer::findOne($answered_question->answer);
            if($answered->is_correct)
                $rigth_answers ++;
        }
        return $rigth_answers;
    }

}
