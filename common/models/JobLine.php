<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "job_line".
 *
 * @property int $id
 * @property int|null $job_id
 * @property int|null $product_id
 * @property string|null $product_name
 * @property float|null $cost_per_unit
 * @property float|null $discount_per
 * @property float|null $dealer_price
 * @property float|null $var_amount
 * @property float|null $total_cost_per_unit
 * @property float|null $qty
 * @property float|null $cost_total
 * @property float|null $quotation_per_unit_price
 * @property float|null $total_quotation_price
 */
class JobLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'product_id'], 'integer'],
            [['cost_per_unit', 'discount_per', 'dealer_price', 'vat_amount', 'total_cost_per_unit', 'qty', 'cost_total', 'quotation_per_unit_price', 'total_quotation_price'], 'number'],
            [['product_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_id' => 'Job ID',
            'product_id' => 'Product ID',
            'product_name' => 'Product Name',
            'cost_per_unit' => 'Cost Per Unit',
            'discount_per' => 'Discount Per',
            'dealer_price' => 'Dealer Price',
            'vat_amount' => 'Var Amount',
            'total_cost_per_unit' => 'Total Cost Per Unit',
            'qty' => 'Qty',
            'cost_total' => 'Cost Total',
            'quotation_per_unit_price' => 'Quotation Per Unit Price',
            'total_quotation_price' => 'Total Quotation Price',
        ];
    }
}
