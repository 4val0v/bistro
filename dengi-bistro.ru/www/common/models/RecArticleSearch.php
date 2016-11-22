<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RecArticle;

/**
 * RecArticleSearch represents the model behind the search form about `common\models\RecArticle`.
 */
class RecArticleSearch extends RecArticle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'article1', 'article2', 'article3'], 'integer'],
            [['img1', 'img2', 'img3'], 'safe'],
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
        $query = RecArticle::find();

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
            'article1' => $this->article1,
            'article2' => $this->article2,
            'article3' => $this->article3,
        ]);

        $query->andFilterWhere(['like', 'img1', $this->img1])
            ->andFilterWhere(['like', 'img2', $this->img2])
            ->andFilterWhere(['like', 'img3', $this->img3]);

        return $dataProvider;
    }
}
