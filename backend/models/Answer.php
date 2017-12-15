<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "answer".
 *
 * @property integer $id
 * @property string $answer
 * @property boolean $is_correct
 * @property string $created_at
 * @property string $updated_at
 * @property integer $question_id
 *
 * @property Question $question
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['answer', 'is_correct', 'created_at', 'updated_at', 'question_id'], 'required'],
            [['is_correct'], 'boolean'],
            [['created_at', 'updated_at'], 'safe'],
            [['question_id'], 'integer'],
            [['answer'], 'string', 'max' => 255],
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
            'answer' => 'Resposta',
            'is_correct' => 'É a Correta?',
            'created_at' => 'Data de Criação',
            'updated_at' => 'Data de Atualização',
            'question_id' => 'Question ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }

    /**
     * @param $model Answer
     * @return bool
     */
    public function saveAnswer($model)
    {
        $model->created_at = date('Y-m-d H:i:s');
        $model->updated_at = date('Y-m-d H:i:s');
        return $model->save();
    }

    /**
     * @param $model Answer
     * @return mixed
     */
    public function updateAnswer($model)
    {
        $model->updated_at = date('Y-m-d H:i:s');
        return $model->save();
    }

    /**
     * @param $answered_quiz_id int
     * @return int|string
     */
    public static function countAnswersByAnsweredQuizId($answered_quiz_id)
    {
        return Answer::find()->where(['answered_id' => $answered_quiz_id])->count();
    }
}
