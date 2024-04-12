<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Fueldailyprice;

/**
 * FueldailypriceSearch represents the model behind the search form of `backend\models\Fueldailyprice`.
 */
class FueldailypriceSearch extends Fueldailyprice
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch;

    public function rules()
    {
        return [
            [['id', 'fuel_id', 'province_id', 'city_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['price_date'], 'safe'],
            [['price'], 'number'],
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
        $query = Fueldailyprice::find();

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
//        $query->orFilterWhere([
//            'id' => $this->globalSearch,
//            'fuel_id' => $this->globalSearch,
//            'province_id' => $this->globalSearch,
//            'city_id' => $this->globalSearch,
//            'price_date' => $this->globalSearch,
//            'price' => $this->globalSearch,
//            'status' => $this->globalSearch,
//            'created_at' => $this->globalSearch,
//            'created_by' => $this->globalSearch,
//            'updated_at' => $this->globalSearch,
//            'updated_by' => $this->globalSearch,
//        ]);

        $query->orFilterWhere(['like', 'fuel_id', $this->globalSearch])
            ->orFilterWhere(['like', 'province_id', $this->globalSearch])
            ->orFilterWhere(['like', 'city_id', $this->globalSearch])
            ->orFilterWhere(['like', 'price', $this->globalSearch]);

        return $dataProvider;
    }
}
