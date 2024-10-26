<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "vendor".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property int|null $vendor_group_id
 * @property string|null $description
 * @property int|null $payment_method_id
 * @property int|null $payment_term_id
 * @property string|null $location
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Vendor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vendor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'string'],
            [['vendor_group_id', 'payment_method_id', 'payment_term_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['code', 'name', 'description', 'location','phone','email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'รหัส',
            'name' => 'ชื่อ',
            'vendor_group_id' => 'กลุ่มผู้ขาย',
            'description' => 'รายละเอียด',
            'payment_method_id' => 'วิธีชำระเงิน',
            'payment_term_id' => 'เงื่อนไขชำระเงิน',
            'location' => 'สาขา',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
