<?php

namespace frontend\models;

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
            [['name'], 'string', 'max' => 255],
            [['email'], 'email'],
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

    /**
     * @param $model WebUser
     * @return mixed
     */
    public function saveWebUser($model)
    {
        if($model->exists($model)) {
            return $model->findByEmail($model->email);

        } else {
            $model->save();
            return $model;
        }
    }

    /**
     * @param $model WebUser
     * @return bool
     */
    public function exists($model)
    {
        if(WebUser::find()->where(['email' => $model->email])->count() != 0)
            return true;
        return false;
    }

    /**
     * @param $model WebUser
     * @return array|null|\yii\db\ActiveRecord
     */
    public function findByEmail($email)
    {
        return WebUser::find()->where(['email' => $email])->one();
    }
}
