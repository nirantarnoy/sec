<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "daily_trans_close".
 *
 * @property int $id
 * @property string|null $trans_date
 * @property int|null $trans_year
 * @property int|null $trans_month
 * @property float|null $balance_amount
 * @property int|null $company_id
 * @property int|null $location_id
 */
class DailyTransClose extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'daily_trans_close';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_date'], 'safe'],
            [['trans_year', 'trans_month', 'company_id', 'location_id'], 'integer'],
            [['balance_amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trans_date' => 'Trans Date',
            'trans_year' => 'Trans Year',
            'trans_month' => 'Trans Month',
            'balance_amount' => 'Balance Amount',
            'company_id' => 'Company ID',
            'location_id' => 'Location ID',
        ];
    }
}
