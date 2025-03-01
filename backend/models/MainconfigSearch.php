<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Mainconfig;

/**
 * MainconfigSearch represents the model behind the search form of `backend\models\Mainconfig`.
 */
class MainconfigSearch extends Mainconfig
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_cal_commission'], 'integer'],
            [['commission_per', 'job_vat_per', 'withholding_per'], 'number'],
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
        $query = Mainconfig::find();

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
            'is_cal_commission' => $this->is_cal_commission,
            'commission_per' => $this->commission_per,
            'job_vat_per' => $this->job_vat_per,
            'withholding_per' => $this->withholding_per,
        ]);

        return $dataProvider;
    }
}
