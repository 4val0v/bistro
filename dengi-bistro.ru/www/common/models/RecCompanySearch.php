<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RecCompany;

/**
 * RecCompanySearch represents the model behind the search form about `common\models\RecCompany`.
 */
class RecCompanySearch extends RecCompany
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'company1', 'company2', 'company3'], 'integer'],
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
        $query = RecCompany::find();

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
            'company1' => $this->company1,
            'company2' => $this->company2,
            'company3' => $this->company3,
        ]);

        return $dataProvider;
    }
}
