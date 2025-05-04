<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Cashadvance;

/**
 * CashadvanceSearch represents the model behind the search form of `backend\models\Cashadvance`.
 */
class CashadvanceSearch extends Cashadvance
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'team_id', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['trans_date', 'name', 'work_name', 'quotation_ref_no', 'remark'], 'safe'],
            [['in_amount', 'out_amount', 'balance_amount', 'distance_total', 'express_amount', 'line_total'], 'number'],
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
        $query = Cashadvance::find();

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
            'trans_date' => $this->trans_date,
            'team_id' => $this->team_id,
            'in_amount' => $this->in_amount,
            'out_amount' => $this->out_amount,
            'balance_amount' => $this->balance_amount,
            'distance_total' => $this->distance_total,
            'express_amount' => $this->express_amount,
            'line_total' => $this->line_total,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'work_name', $this->work_name])
            ->andFilterWhere(['like', 'quotation_ref_no', $this->quotation_ref_no])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
