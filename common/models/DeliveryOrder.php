<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "delivery_order".
 *
 * @property int $id
 * @property string|null $order_no
 * @property string|null $trans_date
 * @property int|null $issue_ref_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class DeliveryOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'delivery_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_date','issue_ref_id'], 'safe'],
            [[ 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['order_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_no' => 'เลขที่ใบส่งของ',
            'trans_date' => 'วันที่',
            'issue_ref_id' => 'เลขที่ใบเบิก',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
