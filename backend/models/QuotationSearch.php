<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Quotation;

/**
 * QuotationSearch represents the model behind the search form of `backend\models\Quotation`.
 */
class QuotationSearch extends Quotation
{
    public $globalSearch;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['quotation_no', 'quotation_date', 'customer_name', 'attn', 'from', 'remark', 'description'], 'safe'],
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
        $query = Quotation::find();

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
            'quotation_date' => $this->quotation_date,
            'customer_id' => $this->customer_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        if($this->globalSearch != null || $this->globalSearch != ''){
            $query->orFilterWhere(['like', 'quotation_no', $this->globalSearch])
                ->orFilterWhere(['like', 'customer_name', $this->globalSearch])
                ->orFilterWhere(['like', 'attn', $this->globalSearch])
                ->orFilterWhere(['like', 'from', $this->globalSearch])
                ->orFilterWhere(['like', 'remark', $this->globalSearch])
                ->orFilterWhere(['like', 'description', $this->globalSearch]);
        }


        return $dataProvider;
    }
}
