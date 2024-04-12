<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "workorder".
 *
 * @property int $id
 * @property string|null $trans_date
 * @property string|null $workorder_no
 * @property int|null $emp_inform_id
 * @property int|null $car_id
 * @property int|null $mile_data
 * @property int|null $is_other
 * @property string|null $other_text
 * @property int|null $approval_emp_id
 * @property int|null $emp_notify_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $car_type_id
 */
class Workorder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workorder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_date'], 'safe'],
            [['emp_inform_id', 'car_id', 'mile_data', 'is_other', 'approval_emp_id', 'emp_notify_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'car_type_id','is_issue_status'], 'integer'],
            [['workorder_no', 'other_text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trans_date' => 'วันที่แจ้งซ่อม',
            'workorder_no' => 'เลขที่ใบแจ้งซ่อม',
            'emp_inform_id' => 'ผู้แจ้งซ่อม',
            'car_id' => 'รถ',
            'mile_data' => 'เลขไมล์',
            'is_other' => 'อื่นๆ',
            'other_text' => 'ข้อความอื่นๆ',
            'approval_emp_id' => 'ผู้อนุมัติ',
            'emp_notify_id' => 'ผู้รับแจ้งซ่อม',
            'status' => 'สถานะ',
            'is_issue_status' => 'สถานะเบิก',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'car_type_id' => 'ประเภทรถ',
        ];
    }
}
