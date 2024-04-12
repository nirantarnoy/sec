<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fuel_daily_price".
 *
 * @property int $id
 * @property int|null $fuel_id
 * @property int|null $province_id
 * @property int|null $city_id
 * @property string|null $price_date
 * @property float|null $price
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class FuelDailyPrice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fuel_daily_price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fuel_id', 'province_id', 'city_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by','car_type_id'], 'integer'],
            [['price_date'], 'safe'],
            [['price','price_add','price_origin'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fuel_id' => 'ชื่อน้ำมัน',
            'province_id' => 'จังหวัด',
            'city_id' => 'อำเภอ',
            'price_date' => 'วันที่',
            'price' => 'ราคา',
            'price_add' => 'ราคาบวกเพิ่ม',
            'price_origin' => 'ราคาตั้ง',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
