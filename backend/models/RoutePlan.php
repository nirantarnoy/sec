<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
date_default_timezone_set('Asia/Bangkok');

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
class RoutePlan extends \common\models\RoutePlan
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
            [['des_province_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by','item_back_id','customer_id','car_type_id','hp'], 'integer'],
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
            'des_name' => 'ชื่อปลายทาง',
            'des_province_id' => 'จังหวัดปลายทาง',
            'total_distanct' => 'ระยะทางไป',
            'status' => 'สถานะ',
            'customer_id' => 'ลูกค้าปลายทาง',
            'hp'=> 'แรงม้า',
            'oil_rate_qty' => 'จำนวนเรทน้ำมัน(ลิตร)',
            'item_back_id' => 'ของนำกลับ',
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

    public function behaviors()
    {
        return [
            'timestampcdate'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>'created_at',
                ],
                'value'=> time(),
            ],
            'timestampudate'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>'updated_at',
                ],
                'value'=> time(),
            ],
            'timestampupdate' => [
                'class' => \yii\behaviors\AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => time(),
            ],
        ];
    }

    public static function findDes($id)
    {
        $model = RoutePlan::find()->where(['id' => $id])->one();
        return $model != null ? $model->des_name : '';
    }
    public static function findDes2($id)
    {
        $customer_name = '';
        $model = RoutePlan::find()->where(['id' => $id])->one();
        if($model){
            $customer_name = \backend\models\Customer::findCusName($model->customer_id);
        }
        return $customer_name;
    }
}
