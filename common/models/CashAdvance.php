<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cash_advance".
 *
 * @property int $id
 * @property string|null $trans_date
 * @property int|null $team_id
 * @property string|null $name
 * @property float|null $in_amount
 * @property float|null $out_amount
 * @property float|null $balance_amount
 * @property string|null $work_name
 * @property string|null $quotation_ref_no
 * @property float|null $distance_total
 * @property float|null $express_amount
 * @property float|null $line_total
 * @property string|null $remark
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_by
 * @property int|null $updated_at
 */
class CashAdvance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cash_advance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_date'], 'safe'],
         //   [['quotation_ref_no'], 'required'],
            [['team_id', 'created_by', 'created_at', 'updated_by', 'updated_at','advance_master_id','trans_month','trans_year'], 'integer'],
            [['in_amount', 'out_amount', 'balance_amount', 'distance_total', 'express_amount', 'line_total'], 'number'],
            [['name', 'work_name', 'quotation_ref_no', 'remark'], 'string', 'max' => 255],
            [['customer_id','trans_type_id'],'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trans_date' => 'วันที่ทำรายการ',
            'team_id' => 'Team ID',
            'name' => 'รายการ',
            'in_amount' => 'รายรับ',
            'out_amount' => 'รายจ่าย',
            'balance_amount' => 'คงเหลือ',
            'work_name' => 'ชื่อลูกค้า',
            'quotation_ref_no' => 'เลขที่ใบเสนอราคา',
            'distance_total' => 'รวมระยะทาง',
            'express_amount' => 'ค่าทางด่วน',
            'line_total' => 'รวม',
            'remark' => 'หมายเหตุ',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'customer_id'=> 'ลูกค้า',
            'trans_type_id'=> 'ประเภทรายการ'
        ];
    }
}
