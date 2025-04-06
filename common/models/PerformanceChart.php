<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "performance_chart".
 *
 * @property int $id
 * @property int|null $perform_year
 * @property int|null $perform_month
 * @property int|null $team_id
 * @property int|null $emp_id
 * @property float|null $sale_amount_month
 * @property float|null $sale_per_month
 * @property float|null $profit_amount
 * @property float|null $profit_per
 * @property int|null $job_quantity
 * @property float|null $job_quantity_per
 * @property float|null $time_atten_per
 * @property float|null $personal_perform_per
 * @property float|null $hight_perform_per
 * @property float|null $low_perform_per
 */
class PerformanceChart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'performance_chart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['perform_year', 'perform_month', 'team_id', 'emp_id', 'job_quantity'], 'integer'],
            [['sale_amount_month', 'sale_per_month', 'profit_amount', 'profit_per', 'job_quantity_per', 'time_atten_per', 'personal_perform_per', 'hight_perform_per', 'low_perform_per'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'perform_year' => 'Perform Year',
            'perform_month' => 'Perform Month',
            'team_id' => 'Team ID',
            'emp_id' => 'Emp ID',
            'sale_amount_month' => 'Sale Amount Month',
            'sale_per_month' => 'Sale Per Month',
            'profit_amount' => 'Profit Amount',
            'profit_per' => 'Profit Per',
            'job_quantity' => 'Job Quantity',
            'job_quantity_per' => 'Job Quantity Per',
            'time_atten_per' => 'Time Atten Per',
            'personal_perform_per' => 'Personal Perform Per',
            'hight_perform_per' => 'Hight Perform Per',
            'low_perform_per' => 'Low Perform Per',
        ];
    }
}
