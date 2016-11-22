<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Page;

/**
 * PageSearch represents the model behind the search form about `common\models\Page`.
 */
class PageSearch extends Page
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'offer_id', 'helpfull', 'folder'], 'integer'],
            [['h1', 'alias', 'short_desc' ,'text_1', 'expert_text', 'text_2', 'seo_title', 'seo_desc', 'seo_keys', 'expert_title'], 'safe'],
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
    public function search($params, $ids, $free)
    {
        $query = Page::find();

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
        if($ids) 
            $d=$ids; 
        else if($free)
            $d = $free;
        else
            $d=$this->id; 
        $query->andFilterWhere([ 
        'id' => $d, 
        'offer_id' => $this->offer_id, 
        'helpfull' => $this->helpfull, 
        ]);

        $query->andFilterWhere(['like', 'h1', $this->h1])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'folder', $this->folder])
            ->andFilterWhere(['like', 'short_desc', $this->short_desc])
            ->andFilterWhere(['like', 'text_1', $this->text_1])
            ->andFilterWhere(['like', 'marked', $this->marked])
            ->andFilterWhere(['like', 'expert_text', $this->expert_text])
            ->andFilterWhere(['like', 'text_2', $this->text_2])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_desc', $this->seo_desc])
            ->andFilterWhere(['like', 'seo_keys', $this->seo_keys])
            ->andFilterWhere(['like', 'expert_title', $this->expert_title]);

        return $dataProvider;
    }
}
