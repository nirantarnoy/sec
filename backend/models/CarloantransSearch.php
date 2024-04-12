<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Carloantrans;

/**
 * CarloantransSearch represents the model behind the search form of `backend\models\Carloantrans`.
 */
class CarloantransSearch extends Carloantrans
{
    public $globalSearch;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'car_loan_id', 'period_no', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['trans_date', 'doc'], 'safe'],
            [['loan_pay_amt'], 'number'],
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
        $query = Carloantrans::find()->join('inner join','car','car_loan_trans.car_loan_id = car.id');

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
            'car_loan_id' => $this->car_loan_id,
            'trans_date' => $this->trans_date,
            'period_no' => $this->period_no,
            'loan_pay_amt' => $this->loan_pay_amt,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        if($this->globalSearch != null){
            $query->orFilterWhere(['like', 'car.name', $this->globalSearch]);
        }



        return $dataProvider;
    }
}
