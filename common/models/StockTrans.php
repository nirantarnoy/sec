<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_trans".
 *
 * @property int $id
 * @property string|null $journal_no
 * @property string|null $trans_date
 * @property int|null $activity_type_id
 * @property int|null $item_id
 * @property float|null $qty
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $stock_type_id
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
            [['activity_type_id', 'item_id', 'created_by', 'created_at', 'stock_type_id','warehouse_id'], 'integer'],
            [['qty'], 'number'],
            [['journal_no'], 'string', 'max' => 255],
            [['trans_ref_id','trans_price'],'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'journal_no' => 'เลขที่อ้างอิง',
            'trans_date' => 'วันที่ทำรายการ',
            'activity_type_id' => 'กิจกรรม',
            'item_id' => 'สินค้า/อะไหล่',
            'qty' => 'จำนวน',
            'trans_price' => 'ราคา',
            'warehouse_id' => 'คลังสินค้า',
            'created_by' => 'ผู้ดำเนินการ',
            'created_at' => 'Created At',
            'stock_type_id' => 'ประเภทสต็อก',
        ];
    }
}
