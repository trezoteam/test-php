<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "web_user".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 *
 * @property AnsweredQuiz[] $answeredQuizzes
 */
class WebUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'web_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['name', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnsweredQuizzes()
    {
        return $this->hasMany(AnsweredQuiz::className(), ['web_user_id' => 'id']);
    }
}
