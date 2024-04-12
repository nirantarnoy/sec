<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fuel".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $fuel_type_id
 * @property int|null $status
 * @property int|null $company_id
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Fuel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fuel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fuel_type_id', 'status', 'company_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['active_price','active_price_date'],'safe'],
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
            'fuel_type_id' => 'ประเภทน้ำมัน',
            'status' => 'สถานะ',
            'company_id' => 'บริษัท',
            'active_price'=>'ราคา',
            'active_price_date'=>'วันที่ราคา',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
