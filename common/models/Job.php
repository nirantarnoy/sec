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
            [['customer_id', 'created_at', 'created_by', 'updated_at', 'updated_by', 'team_id', 'head_id', 'payment_status','job_master_id'], 'integer'],
            [['job_no', 'quotation_ref_no','invoice_ref_no'], 'string', 'max' => 255],
            [['job_type_id','install_team_id','main_distributor_id'],'integer'],
            [['vat_amount','paid_amount','pending_amount','payment_amount'],'number'],
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
            'quotation_ref_no' => 'Quotation Ref No',
            'invoice_ref_no' => 'Invoice Ref No',
            'trans_date' => 'วันที่งาน',
            'customer_id' => 'ลูกค้า',
            'status' => 'สถานะ',
            'created_at' => 'วันที่ทำรายการ',
            'created_by' => 'ทำรายการโดย',
            'updated_at' => 'วันที่แก้ไขรายการ',
            'updated_by' => 'แก้ไขรายการโดย',
            'team_id' => 'ทีม',
            'head_id' => 'ผู้รับผิดชอบ',
            'job_type_id' => 'ประเภทงาน',
            'install_team_id' => 'ทีมติดตั้ง',
            'main_distributor_id' => 'Main Distributor',
            'vat_amount' => 'ยอดภาษีมูลค่าเพิ่ม',
            'paid_amount' => 'ยอดช่างชำระเงิน',
            'pending_amount' => 'ยอดค้างชำระ',
            'payment_amount' => 'ยอดชำระเงิน',
            'payment_status' => 'สถานะชำระเงิน',
        ];
    }
}
