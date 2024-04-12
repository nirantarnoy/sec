<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Recieptrecord;

/**
 * RecieptrecordSearch represents the model behind the search form of `backend\models\Recieptrecord`.
 */
class RecieptrecordSearch extends Recieptrecord
{
    /**
     * {@inheritdoc}
     */

    public $globalSearch;

    public function rules()
    {
        return [
            [['id', 'status', 'create_at', 'created_by'], 'integer'],
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
        $query = Recieptrecord::find();

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
//            'status' => $this->status,
//            'create_at' => $this->create_at,
//            'created_by' => $this->created_by,
//        ]);

        $query->andFilterWhere(['like', 'journal_no', $this->globalSearch]);

        return $dataProvider;
    }
}
