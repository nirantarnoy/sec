<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Customerinvoice;

/**
 * CustomerinvoiceSearch represents the model behind the search form of `backend\models\Customerinvoice`.
 */
class CustomerinvoiceSearch extends Customerinvoice
{
    public $globalSearch;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'order_ref_id', 'vat_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['invioce_no', 'trans_date'], 'safe'],
            [['total_amount', 'vat_amount', 'grand_total_amount'], 'number'],
            [['globalSearch'], 'string'],
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
        $query = Customerinvoice::find();

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
            'order_ref_id' => $this->order_ref_id,
            'total_amount' => $this->total_amount,
            'vat_amount' => $this->vat_amount,
            'grand_total_amount' => $this->grand_total_amount,
            'vat_id' => $this->vat_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        if ($this->globalSearch != '') {
            $query->orFilterWhere(['like', 'invioce_no', $this->globalSearch]);
        }

        return $dataProvider;
    }
}
