<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string|null $order_no
 * @property string|null $order_date
 * @property int|null $customer_id
 * @property string|null $customer_name
 * @property int|null $customer_type
 * @property float|null $total_amount
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_date'], 'safe'],
            [['customer_id', 'customer_type', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by','delivery_status','transfer_bank_account_id','pay_status','quotation_id'], 'integer'],
            [['total_amount','pay_amount'], 'number'],
            [['order_no', 'customer_name','order_tracking_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_no' => 'เลขที่คำสั่งซื้อ',
            'order_date' => 'วันที่สั่งซื้อ',
            'customer_id' => 'ลูกค้า',
            'customer_name' => 'ชื่อลูกค้า',
            'customer_type' => 'ประเภทลูกค้า',
            'total_amount' => 'ยอดรวม',
            'order_tracking_no'=>'เลขที่ติดตามสินค้า',
            'transfer_bank_account_id'=> 'บัญชีรับโอน',
            'status' => 'สถานะ',
            'quotation_id'=> 'เลขใบเสนอราคา',
            'pay_amount' => 'ยอดชำระเงิน',
            'pay_status' => 'สถานะชำระเงิน',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
