<?php

namespace backend\models;

use Yii;
use yii\db\Exception;

/**
 * This is the model class for table "quiz".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AnsweredQuiz[] $answeredQuizzes
 * @property Question[] $questions
 */
class Quiz extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quiz';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'description' => 'Descrição',
            'created_at' => 'Data de Criação',
            'updated_at' => 'Data de Atualização',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnsweredQuizzes()
    {
        return $this->hasMany(AnsweredQuiz::className(), ['quiz_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['quiz_id' => 'id']);
    }

    /**
     * @param $model Quiz
     * @return bool
     */
    public function saveQuiz($model)
    {
        $model->created_at = date('Y-m-d H:i:s');
        $model->updated_at = date('Y-m-d H:i:s');
        return $model->save();
    }

    /**
     * @param $model Quiz
     * @return bool
     */
    public function updateQuiz($model)
    {
        $model->updated_at = date('Y-m-d H:i:s');
        return $model->save();
    }

    /**
     * @param $model Quiz
     * @return bool
     */
    public function deleteQuiz($model)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $questions = Question::find()->where(['quiz_id' => $model->id])->all();
            foreach ($questions as $question)
            {
                /* @var $question Question */
                $question->deleteQuestion($question);
            }

            $model->delete();
            $transaction->commit();

        } catch (Exception $e) {
            $transaction->rollBack();
        }
        return true;
    }
}
