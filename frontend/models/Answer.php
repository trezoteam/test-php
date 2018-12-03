<?php

namespace frontend\models;

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
            'answer' => 'Answer',
            'is_correct' => 'Is Correct',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
     * @param $question_id int
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function findAllByQuestionId($question_id)
    {
        return Answer::find()->where(['question_id' => $question_id])->all();
    }

}
