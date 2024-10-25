<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property string|null $description
 * @property string|null $taxid
 * @property int|null $customer_group_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname','email'], 'required'],
            [['customer_group_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by','payment_term_id','vat_per_id'], 'integer'],
            [['code', 'name', 'description', 'taxid','first_name','last_name'], 'string', 'max' => 255],
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
            'description' => 'รายละเอียด',
            'taxid' => 'เลขที่ประจำตัวผู้เสียภาษี',
            'customer_group_id' => 'กลุ่มลูกค้า',
            'first_name' => 'ชื่อ',
            'last_name' => 'นามสกุล',
            'status' => 'สถานะ',
            'vat_per_id' => 'VAT',
            'payment_term_id'=> 'เครดิต',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
