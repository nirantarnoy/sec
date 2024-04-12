<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $plate_no
 * @property int|null $car_type_id
 * @property int|null $status
 * @property int|null $company_id
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Car extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_type_id', 'status', 'company_id', 'created_at', 'created_by', 'updated_at', 'updated_by','tail_id','brand_id','driver_id'], 'integer'],
            [['name', 'description', 'plate_no','doc'], 'string', 'max' => 255],
            [['horse_power','labur_price','express_road_price'], 'double'],
        ];
    }

    /**
     *
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อ',
            'description' => 'รายละเอียด',
            'plate_no' => 'ป้ายทะเบียน',
            'car_type_id' => 'Car Type ID',
            'brand_id' => 'ยี่ห้อรถ',
            'status' => 'Status',
            'tail_id'=> 'ต่อพ่วง',
            'horse_power'=> 'แรงม้า',
            'doc'=> 'เอกสารรถ',
            'driver_id'=> 'พนักงานขับรถ',
            'labur_price'=>'',
            'express_road_price' => 'ค่าทางด่วน',
            'company_id' => 'Company ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
