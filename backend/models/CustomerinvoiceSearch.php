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
            [['id', 'sale_id', 'customer_id', 'create_at', 'created_by', 'updated_at', 'updated_by', 'status'], 'integer'],
            [['invoice_no', 'invoice_date', 'invoice_target_date', 'work_name', 'total_text', 'remark', 'remark2', 'customer_extend_remark', 'company_extend_remark'], 'safe'],
            [['total_amount', 'vat_amount', 'vat_per', 'total_all_amount'], 'number'],
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
            'invoice_date' => $this->invoice_date,
            'invoice_target_date' => $this->invoice_target_date,
            'sale_id' => $this->sale_id,
            'customer_id' => $this->customer_id,
            'total_amount' => $this->total_amount,
            'vat_amount' => $this->vat_amount,
            'vat_per' => $this->vat_per,
            'total_all_amount' => $this->total_all_amount,
            'create_at' => $this->create_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'status' => $this->status,
        ]);

//        $query->andFilterWhere(['like', 'invoice_no', $this->invoice_no])
//            ->andFilterWhere(['like', 'work_name', $this->work_name])
//            ->andFilterWhere(['like', 'total_text', $this->total_text])
//            ->andFilterWhere(['like', 'remark', $this->remark])
//            ->andFilterWhere(['like', 'remark2', $this->remark2])
//            ->andFilterWhere(['like', 'customer_extend_remark', $this->customer_extend_remark])
//            ->andFilterWhere(['like', 'company_extend_remark', $this->company_extend_remark]);

        if($this->globalSearch != null){
            $query->orFilterWhere(['like','invoice_no',$this->globalSearch]);
        }

        return $dataProvider;
    }
}
