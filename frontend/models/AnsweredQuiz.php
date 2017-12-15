<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "answered_quiz".
 *
 * @property integer $id
 * @property string $start_at
 * @property string $finish_at
 * @property integer $quiz_id
 * @property integer $web_user_id
 *
 * @property AnsweredQuestion[] $answeredQuestions
 * @property Quiz $quiz
 * @property WebUser $webUser
 */
class AnsweredQuiz extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answered_quiz';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_at', 'quiz_id', 'web_user_id'], 'required'],
            [['start_at', 'finish_at'], 'safe'],
            [['quiz_id', 'web_user_id'], 'integer'],
            [['quiz_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quiz::className(), 'targetAttribute' => ['quiz_id' => 'id']],
            [['web_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => WebUser::className(), 'targetAttribute' => ['web_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_at' => 'Start At',
            'finish_at' => 'Finish At',
            'quiz_id' => 'Quiz ID',
            'web_user_id' => 'Web User ID',
        ];
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
     * @return \yii\db\ActiveQuery
     */
    public function getWebUser()
    {
        return $this->hasOne(WebUser::className(), ['id' => 'web_user_id']);
    }

    /**
     * @param $quiz_id int
     * @param $web_user_id int
     * @return AnsweredQuiz
     */
    public function saveAnsweredQuiz($quiz_id, $web_user_id)
    {
        $model = new AnsweredQuiz();
        $model->quiz_id = $quiz_id;
        $model->web_user_id = $web_user_id;
        $model->start_at = date('Y-m-d H:i:s');
        $model->save(false);
        return $model;
    }

    /**
     * @param $web_user_id int
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function getLastByWebUserId($web_user_id)
    {
        return AnsweredQuiz::find()
            ->where(['web_user_id' => $web_user_id])
            ->orderBy('id DESC')
            ->one();
    }

    /**
     * @param $quiz_id int
     * @param $web_user_id int
     * @return AnsweredQuiz
     */
    public function updateAnsweredQuiz($quiz_id, $web_user_id)
    {
        $model = new AnsweredQuiz();
        $model->quiz_id = $quiz_id;
        $model->web_user_id = $web_user_id;
        $model->start_at = date('Y-m-d H:i:s');
        $model->save(false);
        return $model;
    }
}
