<?php

namespace frontend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\AnsweredQuiz;

/**
 * modelsAnsweredQuizSearch represents the model behind the search form about `frontend\models\AnsweredQuiz`.
 */
class modelsAnsweredQuizSearch extends AnsweredQuiz
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'quiz_id', 'web_user_id'], 'integer'],
            [['start_at', 'finish_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = AnsweredQuiz::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'start_at' => $this->start_at,
            'finish_at' => $this->finish_at,
            'quiz_id' => $this->quiz_id,
            'web_user_id' => $this->web_user_id,
        ]);

        return $dataProvider;
    }
}
