<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "view_order_amount".
 *
 * @property int $id
 * @property string|null $order_no
 * @property string|null $order_date
 * @property int|null $customer_id
 * @property string|null $customer_name
 * @property float|null $total_amount
 * @property int|null $status
 * @property int|null $product_id
 * @property string|null $sku
 * @property string|null $name
 * @property string|null $barcode
 * @property int|null $unit_id
 * @property float|null $cost_price
 * @property float|null $sale_price
 * @property float|null $qty
 * @property float|null $price
 * @property int|null $year
 * @property int|null $month
 * @property float|null $cost_amt
 * @property float|null $sale_amt
 */
class ViewOrderAmount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_order_amount';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'status', 'product_id', 'unit_id', 'year', 'month'], 'integer'],
            [['order_date'], 'safe'],
            [['total_amount', 'cost_price', 'sale_price', 'qty', 'price', 'cost_amt', 'sale_amt'], 'number'],
            [['order_no', 'customer_name', 'sku', 'name', 'barcode'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_no' => 'Order No',
            'order_date' => 'Order Date',
            'customer_id' => 'Customer ID',
            'customer_name' => 'Customer Name',
            'total_amount' => 'Total Amount',
            'status' => 'Status',
            'product_id' => 'Product ID',
            'sku' => 'Sku',
            'name' => 'Name',
            'barcode' => 'Barcode',
            'unit_id' => 'Unit ID',
            'cost_price' => 'Cost Price',
            'sale_price' => 'Sale Price',
            'qty' => 'Qty',
            'price' => 'Price',
            'year' => 'Year',
            'month' => 'Month',
            'cost_amt' => 'Cost Amt',
            'sale_amt' => 'Sale Amt',
        ];
    }
}
