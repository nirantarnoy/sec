<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "team_extra_com_line".
 *
 * @property int $id
 * @property int|null $team_extra_com_id
 * @property int|null $emp_id
 * @property float|null $sale_price
 * @property float|null $sale_profit
 * @property float|null $ptar_per
 * @property float|null $ppr_per
 * @property float|null $sum_ttat
 * @property float|null $sum_ptar
 * @property float|null $sum_ppr
 * @property float|null $sum_total
 */
class TeamExtraComLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team_extra_com_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['team_extra_com_id', 'emp_id'], 'integer'],
            [['sale_price', 'sale_profit', 'ptar_per', 'ppr_per', 'sum_ttat', 'sum_ptar', 'sum_ppr', 'sum_total'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'team_extra_com_id' => 'Team Extra Com ID',
            'emp_id' => 'Emp ID',
            'sale_price' => 'Sale Price',
            'sale_profit' => 'Sale Profit',
            'ptar_per' => 'Ptar Per',
            'ppr_per' => 'Ppr Per',
            'sum_ttat' => 'Sum Ttat',
            'sum_ptar' => 'Sum Ptar',
            'sum_ppr' => 'Sum Ppr',
            'sum_total' => 'Sum Total',
        ];
    }
}
