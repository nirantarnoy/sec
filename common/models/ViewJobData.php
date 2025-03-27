<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "view_job_data".
 *
 * @property int $id
 * @property string|null $job_no
 * @property int|null $product_id
 * @property string|null $product_name
 * @property float|null $cost_per_unit
 * @property float|null $discount_per
 * @property float|null $dealer_price
 * @property float|null $vat_amount
 * @property float|null $total_cost_per_unit
 * @property float|null $qty
 * @property float|null $cost_total
 * @property float|null $quotation_per_unit_price
 * @property float|null $total_quotation_price
 * @property int|null $stock_type_id
 * @property string|null $distributor_info
 * @property int|null $cost_category_type
 * @property int|null $vat_type
 * @property int|null $withholdingtax
 * @property string|null $sku
 * @property int|null $product_cat_id
 * @property int|null $brand_id
 * @property string|null $model_name
 * @property int|null $cal_type_id
 */
class ViewJobData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_job_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'stock_type_id', 'cost_category_type', 'vat_type', 'withholdingtax', 'product_cat_id', 'brand_id', 'cal_type_id'], 'integer'],
            [['cost_per_unit', 'discount_per', 'dealer_price', 'vat_amount', 'total_cost_per_unit', 'qty', 'cost_total', 'quotation_per_unit_price', 'total_quotation_price'], 'number'],
            [['job_no', 'product_name', 'distributor_info', 'sku', 'model_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_no' => 'Job No',
            'product_id' => 'Product ID',
            'product_name' => 'Product Name',
            'cost_per_unit' => 'Cost Per Unit',
            'discount_per' => 'Discount Per',
            'dealer_price' => 'Dealer Price',
            'vat_amount' => 'Vat Amount',
            'total_cost_per_unit' => 'Total Cost Per Unit',
            'qty' => 'Qty',
            'cost_total' => 'Cost Total',
            'quotation_per_unit_price' => 'Quotation Per Unit Price',
            'total_quotation_price' => 'Total Quotation Price',
            'stock_type_id' => 'Stock Type ID',
            'distributor_info' => 'Distributor Info',
            'cost_category_type' => 'Cost Category Type',
            'vat_type' => 'Vat Type',
            'withholdingtax' => 'Withholdingtax',
            'sku' => 'Sku',
            'product_cat_id' => 'Product Cat ID',
            'brand_id' => 'Brand ID',
            'model_name' => 'Model Name',
            'cal_type_id' => 'Cal Type ID',
        ];
    }
}
