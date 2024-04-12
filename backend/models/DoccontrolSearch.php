<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Doccontrol;

/**
 * DoccontrolSearch represents the model behind the search form of `backend\models\Doccontrol`.
 */
class DoccontrolSearch extends Doccontrol
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'status', 'created_at', 'created_by'], 'integer'],
            [['name', 'description', 'doc_file', 'start_date', 'exp_date'], 'safe'],
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
        $query = Doccontrol::find();

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
            'company_id' => $this->company_id,
            'start_date' => $this->start_date,
//            'exp_date' => $this->exp_date,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ]);

        if($this->exp_date!=null){
            $xp_date = null;
            $xdata = explode('-',$this->exp_date);
            if($xdata!=null){
                if(count($xdata)>1){
                    $xp_date = $xdata[2].'/'.$xdata[1].'/'.$xdata[0];
                }
            }
            if($xp_date!= null){
                $query->andFilterWhere(['date(exp_date)'=>date('Y-m-d',strtotime($xp_date))]);
            }
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'doc_file', $this->doc_file]);

        return $dataProvider;
    }
}
