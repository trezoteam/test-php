<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property string $subject
 * @property boolean $type
 * @property string $created_at
 * @property string $updated_at
 * @property integer $quiz_id
 *
 * @property Answer[] $answers
 * @property AnsweredQuestion[] $answeredQuestions
 * @property Quiz $quiz
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'type', 'created_at', 'updated_at', 'quiz_id'], 'required'],
            [['type'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['quiz_id'], 'integer'],
            [['subject'], 'string', 'max' => 255],
            [['quiz_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quiz::className(), 'targetAttribute' => ['quiz_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => 'Subject',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'quiz_id' => 'Quiz ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnsweredQuestions()
    {
        return $this->hasMany(AnsweredQuestion::className(), ['answered_quiz_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuiz()
    {
        return $this->hasOne(Quiz::className(), ['id' => 'quiz_id']);
    }

    /**
     * @param $quiz_id int
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function findAllByQuizId($quiz_id)
    {
        return Question::find()->where(['quiz_id' => $quiz_id])->all();
    }
}
