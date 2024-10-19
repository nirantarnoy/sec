<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Purch;

/**
 * PurchSearch represents the model behind the search form of `backend\models\Purch`.
 */
class PurchSearch extends Purch
{
    public $globalSearch;
    public function rules()
    {
        return [
            [['id', 'customer_id', 'payment_term_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['purch_no', 'purch_date', 'note'], 'safe'],
            [['globalSearch'],'string']
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
        $query = Purch::find();

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
            'purch_date' => $this->purch_date,
            'customer_id' => $this->customer_id,
            'payment_term_id' => $this->payment_term_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);
        if($this->globalSearch != ''){
            $query->orFilterWhere(['like', 'purch_no', $this->globalSearch])
                ->orFilterWhere(['like', 'note', $this->globalSearch]);
        }


        return $dataProvider;
    }
}
