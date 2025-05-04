<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "team_extra_com".
 *
 * @property int $id
 * @property int|null $target_year_id
 * @property float|null $total_sale_price
 * @property float|null $total_sale_profit
 * @property float|null $ttar_per
 * @property float|null $ttar_amount
 */
class TeamExtraCom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team_extra_com';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['target_year_id'], 'integer'],
            [['total_sale_price', 'total_sale_profit', 'ttar_per', 'ttar_amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'target_year_id' => 'Target Year ID',
            'total_sale_price' => 'Total Sale Price',
            'total_sale_profit' => 'Total Sale Profit',
            'ttar_per' => 'Ttar Per',
            'ttar_amount' => 'Ttar Amount',
        ];
    }
}
