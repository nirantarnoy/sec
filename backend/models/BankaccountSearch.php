<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Bankaccount;

/**
 * BankaccountSearch represents the model behind the search form of `backend\models\Bankaccount`.
 */
class BankaccountSearch extends Bankaccount
{
    public $globalSearch;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'bank_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['account_name', 'description', 'account_no'], 'safe'],
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
        $query = Bankaccount::find();

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
            'bank_id' => $this->bank_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        if ($this->globalSearch != '') {
            $query->orFilterWhere(['like', 'account_name', $this->globalSearch])
                ->orFilterWhere(['like', 'description', $this->globalSearch])
                ->orFilterWhere(['like', 'account_no', $this->globalSearch]);
        }


        return $dataProvider;
    }
}
