<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer_product_price".
 *
 * @property int $id
 * @property int|null $customer_id
 * @property int|null $product_id
 * @property float|null $sale_price
 * @property int|null $status
 * @property string|null $price_date
 */
class CustomerProductPrice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_product_price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'product_id', 'status'], 'integer'],
            [['sale_price'], 'number'],
            [['price_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'product_id' => 'Product ID',
            'sale_price' => 'Sale Price',
            'status' => 'Status',
            'price_date' => 'Price Date',
        ];
    }
}
