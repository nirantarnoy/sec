<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "job_master".
 *
 * @property int $id
 * @property int|null $team_id
 * @property int|null $emp_id
 * @property string|null $job_month
 * @property int|null $approve_payment_status
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class JobMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['team_id','emp_id','job_month'],'required'],
            [['team_id', 'emp_id', 'approve_payment_status', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['job_month'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'team_id' => 'ทีมขาย / Sales Team',
            'emp_id' => 'ผู้รับผิดชอบ / Responsible Person',
            'job_month' => 'สรุปยอดขายประจำเดือน / Monthly',
            'approve_payment_status' => 'สถานะอนุมัติการจ่ายเงิน / Payment Status',
            'status' => 'สถานะ / Status',
            'created_at' => 'สร้างเมื่อ',
            'created_by' => 'สร้างโดย',
            'updated_at' => 'แก้ไขเมื่อ',
            'updated_by' => 'แก้ไขโดย',
        ];
    }
}
