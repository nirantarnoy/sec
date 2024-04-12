<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "route_plan_price".
 *
 * @property int $id
 * @property int|null $route_plan_id
 * @property int|null $car_type_id
 * @property float|null $labour_price
 * @property float|null $express_road_price    
 * @property int|null $status
 */
class RoutePlanPrice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'route_plan_price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['route_plan_id', 'car_type_id', 'status','trail_id'], 'integer'],
            [['labour_price', 'express_road_price','other_price','trail_labour_price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'route_plan_id' => 'Route Plan ID',
            'car_type_id' => 'Car Type ID',
            'labour_price' => 'Labour Price',
            'express_road_price' => 'Express Road Price',
            'other_price'=> 'Other Price',
            'status' => 'Status',
        ];
    }
}
