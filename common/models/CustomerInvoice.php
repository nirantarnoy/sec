<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer_invoice".
 *
 * @property int $id
 * @property string|null $invioce_no
 * @property string|null $trans_date
 * @property int|null $order_ref_id
 * @property float|null $total_amount
 * @property float|null $vat_amount
 * @property float|null $grand_total_amount
 * @property int|null $vat_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class CustomerInvoice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_invoice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_date'], 'safe'],
            [['order_ref_id', 'vat_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['total_amount', 'vat_amount', 'grand_total_amount'], 'number'],
            [['invoice_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_no' => 'เลขที่ใบกำกับภาษี',
            'trans_date' => 'วันที่',
            'order_ref_id' => 'คำสั่งซื้อ',
            'total_amount' => 'ยอดเงินทั้งหมด',
            'vat_amount' => 'ยอด vat',
            'grand_total_amount' => 'ยอดเงินสุทธิ',
            'vat_id' => 'vat',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
