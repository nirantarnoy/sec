<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "delivery_order_line".
 *
 * @property int $id
 * @property int|null $delivery_order_id
 * @property int|null $product_id
 * @property string|null $name
 * @property float|null $qty
 * @property int|null $status
 */
class DeliveryOrderLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'delivery_order_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['delivery_order_id', 'product_id', 'status'], 'integer'],
            [['qty'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'delivery_order_id' => 'Delivery Order ID',
            'product_id' => 'Product ID',
            'name' => 'Name',
            'qty' => 'Qty',
            'status' => 'Status',
        ];
    }
}
