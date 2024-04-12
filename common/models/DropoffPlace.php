<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dropoff_place".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class DropoffPlace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dropoff_place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by','hp','car_type_id'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['oil_rate_qty','oil_rate_qty_1'],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อ',
            'description' => 'รายละเอียด',
            'hp' => 'แรงม้า',
            'oil_rate_qty' => 'จำนวนเรทน้ำมันหนัก(ลิตร)',
            'oil_rate_qty_1' => 'จำนวนเรทน้ำมันเบา(ลิตร)',
            'status' => 'สถานะ',
            'car_type_id'=>'ประเภทรถ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
