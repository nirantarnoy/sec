<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quotation".
 *
 * @property int $id
 * @property string|null $quotation_no
 * @property string|null $quotation_date
 * @property int|null $customer_id
 * @property string|null $customer_name
 * @property string|null $attn
 * @property string|null $from
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property string|null $remark
 * @property string|null $description
 */
class Quotation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quotation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id'],'required'],
            [['quotation_date'], 'safe'],
            [['customer_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by','attn_id'], 'integer'],
            [['quotation_no', 'customer_name', 'attn', 'from', 'remark', 'description','total_text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quotation_no' => 'เลขที่ใบเสนอราคา',
            'quotation_date' => 'วันที่เสนอราคา',
            'customer_id' => 'ลูกค้า',
            'customer_name' => 'ชื่อลูกค้า',
            'attn_id' => 'Attn',
            'attn' => 'Attn Name',
            'from' => 'From',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'remark' => 'หมายเหตุ',
            'description' => 'รายละเอียด',
        ];
    }
}
