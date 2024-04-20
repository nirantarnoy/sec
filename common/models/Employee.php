<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $fname
 * @property string|null $lname
 * @property int|null $gender
 * @property int|null $position
 * @property int|null $salary_type
 * @property string|null $emp_start
 * @property string|null $description
 * @property string|null $photo
 * @property int|null $status
 * @property int|null $company_id
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gender', 'position', 'salary_type', 'status', 'company_id', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['emp_start'], 'safe'],
            [['code', 'fname', 'lname', 'description', 'photo'], 'string', 'max' => 255],
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
            'fname' => 'ชื่อ',
            'lname' => 'นามสกุล',
            'gender' => 'เพศ',
            'position' => 'ตำแหน่ง',
            'salary_type' => 'Salary Type',
            'emp_start' => 'Emp Start',
            'description' => 'รายละเอียด',
            'photo' => 'รูปภาพ',
            'status' => 'สถานะ',
            'company_id' => 'Company ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
