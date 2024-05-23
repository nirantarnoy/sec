<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "delivery_order_cal".
 *
 * @property int $id
 * @property int|null $delivery_order_id
 * @property int|null $delivery_line_id
 * @property int|null $product_id
 * @property float|null $qty_per_pack
 * @property float|null $total_pack
 * @property float|null $left_qty
 * @property int|null $status
 */
class DeliveryOrderCal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'delivery_order_cal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['delivery_order_id', 'delivery_line_id', 'product_id', 'status','stock_sum_id'], 'integer'],
            [['qty_per_pack', 'total_pack', 'left_qty','issue_qty'], 'number'],
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
            'delivery_line_id' => 'Delivery Line ID',
            'product_id' => 'Product ID',
            'qty_per_pack' => 'Qty Per Pack',
            'total_pack' => 'Total Pack',
            'left_qty' => 'Left Qty',
            'status' => 'Status',
        ];
    }
}
