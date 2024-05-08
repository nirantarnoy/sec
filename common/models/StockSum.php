<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_sum".
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $warehouse_id
 * @property float|null $qty
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class StockSum extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock_sum';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'warehouse_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['qty'], 'number'],
            [['expired_date'],'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'รหัสสินค้า',
            'warehouse_id' => 'คลังสินค้า',
            'qty' => 'จำนวน',
            'expired_date' => 'วันที่หมดอายุ',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
