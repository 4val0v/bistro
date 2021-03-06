<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Company;

/**
 * CompanySearch represents the model behind the search form about `backend\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'max_sum', 'old', 'stars', 'raiting', 'checked'], 'integer'],
            [['name', 'alias', 'h1', 'title', 'seo_desc', 'seo_keys', 'desc', 'lit_desc', 'vk_group', 'fb_group', 'pay', 'watch', 'href', 'last_upd'], 'safe'],
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
    public function search($params, $active)
    {
        $query = Company::find();

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
            'max_sum' => $this->max_sum,
            'old' => $this->old,
            'stars' => $this->stars,
            'raiting' => $this->raiting,
            'checked' => $this->checked,
        ]);
        if($active){
            $query->andWhere(['!=', 'href', '']);
        }
        else{
            $query->andFilterWhere(['like', 'href', $this->href]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'h1', $this->h1])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'seo_desc', $this->seo_desc])
            ->andFilterWhere(['like', 'seo_keys', $this->seo_keys])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'lit_desc', $this->lit_desc])
            ->andFilterWhere(['like', 'vk_group', $this->vk_group])
            ->andFilterWhere(['like', 'fb_group', $this->fb_group])
            ->andFilterWhere(['like', 'pay', $this->pay])
            ->andFilterWhere(['like', 'watch', $this->watch])
            //->andFilterWhere(['like', 'href', $this->href])
            ->andFilterWhere(['like', 'last_upd', $this->last_upd]);

        return $dataProvider;
    }
}
