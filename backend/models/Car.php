<?php

namespace backend\models;

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
class Car extends \common\models\Car
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
            [['car_type_id', 'status', 'company_id', 'created_at', 'created_by', 'updated_at', 'updated_by','type_id','fuel_type','brand_id','driver_id'], 'integer'],
            [['name', 'description', 'plate_no','doc'], 'string', 'max' => 255],
            [['horse_power'], 'double'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'รถ',
            'description' => 'รายละเอียด',
            'plate_no' => 'ป้ายทะเบียน',
            'car_type_id' => 'ประเภทรถ',
            'brand_id' => 'ยี่ห้อรถ',
            'type_id' => 'ลักษณะรถ',
            'fuel_type' => 'น้ำมัน',
            'status' => 'สถานะ',
            'doc' => 'เอกสารรถ',
            'driver_id'=> 'พนักงานขับรถ',
            'horse_power' => 'แรงม้า',
            'company_id' => 'บริษัท',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public static function findName($id)
    {
        $model = Car::find()->where(['id' => $id])->one();
        return $model != null ? $model->name : '';
    }

    public static function getPlateno($id)
    {
        $model = Car::find()->where(['id' => $id])->one();
        return $model != null ? $model->plate_no : '-';
    }
    public static function findDrivername($id)
    {
        $model = Car::find()->where(['id' => $id])->one();
        return $model != null ? \backend\models\Employee::findFullName($model->driver_id) : '';
    }
    public static function getHp($id)
    {
        $model = Car::find()->where(['id' => $id])->one();
        return $model != null ? $model->horse_power : '-';
    }
    public static function getCartype($id)
    {
        $model = Car::find()->where(['id' => $id])->one();
        if ($model){
            $car_type = \backend\models\CarType::findName($model->car_type_id);
            return $car_type;
        }
        return '';
    }
    public static function getCartypeId($id)
    {
        $model = Car::find()->where(['id' => $id])->one();
        if ($model){
           return $model->car_type_id;

        }
        return 0;
    }

    public static function getDriver($id)
    {
        $model = Car::find()->where(['id' => $id])->one();
        return $model != null ? $model->driver_id : 0;
    }
}
