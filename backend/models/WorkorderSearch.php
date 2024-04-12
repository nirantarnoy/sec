<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Workorder;

/**
 * WorkorderSearch represents the model behind the search form of `backend\models\Workorder`.
 */
class WorkorderSearch extends Workorder
{
    public $globalSearch;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'emp_inform_id', 'car_id', 'mile_data', 'is_other', 'approval_emp_id', 'emp_notify_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'car_type_id'], 'integer'],
            [['trans_date', 'workorder_no', 'other_text'], 'safe'],
            [['globalSearch'],'string'],
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
        $query = Workorder::find();

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
            'emp_inform_id' => $this->emp_inform_id,
            'car_id' => $this->car_id,
            'mile_data' => $this->mile_data,
            'is_other' => $this->is_other,
            'approval_emp_id' => $this->approval_emp_id,
            'emp_notify_id' => $this->emp_notify_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'car_type_id' => $this->car_type_id,
        ]);

        if($this->globalSearch!=''){
            $query->orFilterWhere(['like', 'workorder_no', $this->globalSearch])
                ->orFilterWhere(['like', 'other_text', $this->globalSearch]);
        }


        return $dataProvider;
    }
}
