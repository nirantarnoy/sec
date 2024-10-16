<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_trans".
 *
 * @property int $id
 * @property string|null $trans_date
 * @property int|null $activity_type_id
 * @property int|null $product_id
 * @property float|null $qty
 * @property int|null $trans_ref_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property string|null $remark
 */
class StockTrans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock_trans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_date'], 'safe'],
            [['activity_type_id', 'product_id', 'trans_ref_id', 'status', 'created_at', 'created_by','warehouse_id'], 'integer'],
            [['qty'], 'number'],
            [['remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trans_date' => 'วันที่',
            'activity_type_id' => 'กิจกรรม',
            'product_id' => 'รหัสสินค้า',
            'qty' => 'จำนวน',
            'trans_ref_id' => 'อ้างอิง',
            'warehouse_id'=> 'คลังสินค้า',
            'status' => 'สถานะ',
            'stock_type_id' => 'ประเภทสต๊อก',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'remark' => 'หมายเหตุ',
        ];
    }
}
