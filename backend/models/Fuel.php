<?php

namespace backend\models;

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
class Fuel extends \common\models\Fuel
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
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public static function findName($id)
    {
        $model = Fuel::find()->where(['id' => $id])->one();
        return $model != null ? $model->name : '';
    }

    public static function findId($name)
    {
        $model = Fuel::find()->where(['name' => trim($name)])->one();
        return $model != null ? $model->id : 0;
    }
}
