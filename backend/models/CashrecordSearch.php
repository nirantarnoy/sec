<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Cashrecord;

/**
 * CashrecordSearch represents the model behind the search form of `backend\models\Cashrecord`.
 */
class CashrecordSearch extends Cashrecord
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;

    public function rules()
    {
        return [
            [['id', 'car_id', 'car_tail_id', 'status', 'created_at', 'create_by', 'updated_at', 'updated_by'], 'integer'],
            [['journal_no', 'trans_date','globalSearch'], 'safe'],
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
        $query = Cashrecord::find();

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
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'trans_date' => $this->trans_date,
//            'car_id' => $this->car_id,
//            'car_tail_id' => $this->car_tail_id,
//            'status' => $this->status,
//            'created_at' => $this->created_at,
//            'create_by' => $this->create_by,
//            'updated_at' => $this->updated_at,
//            'updated_by' => $this->updated_by,
//        ]);

        $query->andFilterWhere(['like', 'journal_no', $this->globalSearch]);

        return $dataProvider;
    }
}
