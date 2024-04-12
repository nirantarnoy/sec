<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_loan".
 *
 * @property int $id
 * @property int|null $car_id
 * @property int|null $total_period
 * @property float|null $period_amount
 * @property int|null $status
 */
class CarLoan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car_loan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_id', 'total_period', 'status'], 'integer'],
            [['period_amount','loan_amount'], 'number'],
            [['doc_no'],'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_id' => 'Car ID',
            'total_period' => 'Total Period',
            'period_amount' => 'Period Amount',
            'loan_amount'=> 'Loan Amount',
            'doc_no'=>'เลขที่สัญญา',
            'status' => 'Status',
        ];
    }
}
