<?php

namespace backend\models;

use Yii;
use yii\db\Exception;

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
            'subject' => 'Assunto',
            'type' => 'Tipo',
            'created_at' => 'Data de Criação',
            'updated_at' => 'Data de Atualização',
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
     * @param $model Question
     * @return bool
     */
    public function saveQuestion($model)
    {
        $model->created_at = date('Y-m-d H:i:s');
        $model->updated_at = date('Y-m-d H:i:s');
        return $model->save();
    }

    /**
     * @param $model Question
     */
    public function updateQuestion($model)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $model->updated_at = date('Y-m-d H:i:s');
            if (!$model->type) {
                $answer = new Answer();
                $answer->find()->where(['question_id' => $model->id])->all();
                $answer->deleteAll();
            }
            $model->save();
            $transaction->commit();

        } catch (Exception $e) {
            $transaction->rollBack();
        }
        return true;
    }

    /**
     * @param $model Question
     * @return bool
     */
    public function deleteQuestion($model)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $answer = new Answer();
            $answer->find()->where(['question_id' => $model->id])->all();
            $answer->deleteAll();

            $model->delete();
            $transaction->commit();

        } catch (Exception $e) {
            $transaction->rollBack();
        }
        return true;
    }
}
