<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "purch_line".
 *
 * @property int $id
 * @property int|null $purch_id
 * @property int|null $product_id
 * @property float|null $qty
 * @property float|null $price
 * @property float|null $line_total
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class PurchLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purch_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['purch_id', 'product_id', 'status', 'created_at', 'updated_at','purch_req_id'], 'integer'],
            [['qty', 'price', 'line_total','remain_qty'], 'number'],
            [['product_name'],'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'purch_id' => 'Purch ID',
            'product_id' => 'Product ID',
            'qty' => 'Qty',
            'price' => 'Price',
            'line_total' => 'Line Total',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
