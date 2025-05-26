<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "job".
 *
 * @property int $id
 * @property string|null $job_no
 * @property string|null $quotation_ref_no
 * @property string|null $trans_date
 * @property int|null $customer_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $team_id
 * @property int|null $head_id
 * @property int|null $payment_status
 */
class Job extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
          //  [['name'],'required'],
            [['quotation_ref_no'],'unique','targetAttribute' => ['quotation_ref_no']],
            [['trans_date','status'], 'safe'],
            [['customer_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'team_id', 'head_id', 'payment_status','job_master_id',], 'integer'],
            [['job_no', 'quotation_ref_no','invoice_ref_no','remark','job_type_description'], 'string', 'max' => 255],
            [['job_type_id','install_team_id','main_distributor_id','set_to_zero'],'integer'],
            [['vat_amount','payment_amount','withholding_amount'],'number'],
            [['pending_amount','job_value_amount','job_cost_amount','job_benefit_amount','job_benefit_per','commission_amount','paid_amount'],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_master_id' => 'Job Master ID',
            'job_no' => 'เลขที่งาน',
            'quotation_ref_no' => 'ใบเสนอราคา',
            'invoice_ref_no' => 'ใบกำกับภาษี',
            'trans_date' => 'วันที่งาน',
            'customer_id' => 'ลูกค้า',
            'status' => 'สถานะ',
            'created_at' => 'วันที่ทำรายการ',
            'created_by' => 'ทำรายการโดย',
            'updated_at' => 'วันที่แก้ไขรายการ',
            'updated_by' => 'แก้ไขรายการโดย',
            'team_id' => 'ทีมขาย',
            'head_id' => 'พนักงานขาย',
            'job_type_id' => 'ประเภทงาน',
            'install_team_id' => 'ทีมติดตั้ง',
            'main_distributor_id' => 'ผู้นำเข้าหลัก',
            'vat_amount' => 'ยอดภาษีมูลค่าเพิ่ม',
            'paid_amount' => 'เงินที่ชำระแล้ว',
            'pending_amount' => 'เงินที่ค้างชำระ',
            'payment_amount' => 'ยอดชำระเงิน',
            'payment_status' => 'สถานะการจ่ายเงิน',
            'withholding_amount'=>'เงินที่หักภาษี ณ ที่จ่าย',
            'set_to_zero'=>'ปรับยอดเป็นศูนย์',
            'job_value_amount'=>'มูลค่างาน',
            'job_cost_amount'=>'ต้นทุนรวม',
            'job_benefit_amount'=>'กำไรรวม',
            'job_benefit_per'=>'%กำไร',
            'commission_amount'=>'ค่าคอมมิชชั่น',
            'remark' => 'หมายเหตุ',
            'job_type_description' => 'อื่นๆ',
        ];
    }
}
