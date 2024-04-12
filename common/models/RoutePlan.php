<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "route_plan".
 *
 * @property int $id
 * @property string|null $des_name
 * @property int|null $des_province_id
 * @property float|null $total_distanct
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class RoutePlan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'route_plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['des_province_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by','customer_id','hp','item_back_id','car_type_id'], 'integer'],
            [['total_distanct','oil_rate_qty','labour_price','express_road_price','total_distance_back'], 'number'],
            [['des_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'des_name' => 'Des Name',
            'des_province_id' => 'Des Province ID',
            'total_distanct' => 'Total Distanct',
            'status' => 'Status',
            'customer_id' => 'ลูกค้าปลายทาง',
            'hp'=> 'แรงม้า',
            'item_back_id' => 'ของนำกลับ',
            'oil_rate_qty' => 'จำนวนเรทน้ำมัน(ลิตร)',
            'car_type_id' => 'ประเภทรถ',
            'labour_price' => 'ค่าแรง',
            'express_road_price'=> 'ค่าทางด่วน',
            'total_distance_back'=> 'ระยะทางกลับ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
