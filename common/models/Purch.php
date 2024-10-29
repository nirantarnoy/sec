<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "purch".
 *
 * @property int $id
 * @property string|null $purch_no
 * @property string|null $purch_date
 * @property int|null $customer_id
 * @property int|null $payment_term_id
 * @property string|null $note
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Purch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vendor_id'],'required'],
            [['purch_date'], 'safe'],
            [['customer_id', 'payment_term_id', 'created_at', 'created_by', 'updated_at', 'updated_by','vendor_id'], 'integer'],
            [['purch_no', 'note'], 'string', 'max' => 255],
            [['status'],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'purch_no' => 'เลขที่สั่งซื้อ',
            'purch_date' => 'วันที่',
            'customer_id' => 'ลูกค้า',
            'vendor_id' => 'ผู้ขาย',
            'payment_term_id' => 'เงื่อนไขชำระเงิน',
            'note' => 'Note',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
