<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "route_plan_line".
 *
 * @property int $id
 * @property int|null $route_plan_id
 * @property int|null $dropoff_place_id
 * @property float|null $dropoff_qty
 * @property int|null $status
 */
class RoutePlanLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'route_plan_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['route_plan_id', 'dropoff_place_id', 'status'], 'integer'],
            [['dropoff_qty'], 'number'],
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
            'dropoff_place_id' => 'Dropoff Place ID',
            'dropoff_qty' => 'Dropoff Qty',
            'status' => 'Status',
        ];
    }
}
