<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "driver_license".
 *
 * @property int $id
 * @property int|null $emp_id
 * @property int|null $seq_no
 * @property int|null $license_type_id
 * @property string|null $license_no
 * @property string|null $issue_date
 * @property string|null $issue_by
 * @property string|null $expired_date
 * @property string|null $license_photo
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class DriverLicense extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'driver_license';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emp_id', 'seq_no', 'license_type_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['issue_date', 'expired_date'], 'safe'],
            [['license_no', 'issue_by', 'license_photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'emp_id' => 'Emp ID',
            'seq_no' => 'Seq No',
            'license_type_id' => 'License Type ID',
            'license_no' => 'License No',
            'issue_date' => 'Issue Date',
            'issue_by' => 'Issue By',
            'expired_date' => 'Expired Date',
            'license_photo' => 'License Photo',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
