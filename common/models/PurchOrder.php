<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "purch_order".
 *
 * @property int $id
 * @property string|null $purch_no
 * @property string|null $trans_date
 * @property int|null $department_id
 * @property string|null $reason
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class PurchOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purch_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_date'], 'safe'],
            [['department_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by','purch_by','vendor_id'], 'integer'],
            [['purch_no', 'reason'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'purch_no' => 'เลขที่คำสั่งซ์้อ',
            'vendor_id' => 'ผู้ขาย',
            'trans_date' => 'วันที่',
            'department_id' => 'แผนก',
            'reason' => 'เหตุผลสั่งซื้อ',
            'status' => 'สถานะ',
            'purch_by' => 'ผู้สั่งซื้อ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
