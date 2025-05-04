<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Advancetable;

/**
 * AdvancetableSearch represents the model behind the search form of `backend\models\Advancetable`.
 */
class AdvancetableSearch extends Advancetable
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'trans_month', 'trans_year', 'team_id', 'created_by', 'created_at', 'updated_at', 'updated_by'], 'integer'],
            [['total_balance'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Advancetable::find();

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
            'trans_month' => $this->trans_month,
            'trans_year' => $this->trans_year,
            'team_id' => $this->team_id,
            'total_balance' => $this->total_balance,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
