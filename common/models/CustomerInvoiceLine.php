<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer_invoice_line".
 *
 * @property int $id
 * @property int|null $customer_invoice_id
 * @property int|null $product_id
 * @property float|null $qty
 * @property float|null $price
 * @property float|null $line_discount
 * @property float|null $line_amount
 * @property int|null $status
 */
class CustomerInvoiceLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_invoice_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_invoice_id', 'product_id', 'status'], 'integer'],
            [['qty', 'price', 'line_discount', 'line_amount'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_invoice_id' => 'Customer Invoice ID',
            'product_id' => 'Product ID',
            'qty' => 'Qty',
            'price' => 'Price',
            'line_discount' => 'Line Discount',
            'line_amount' => 'Line Amount',
            'status' => 'Status',
        ];
    }
}
