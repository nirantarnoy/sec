<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cityzone".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $province_id
 * @property int|null $city_id
 */
class Cityzone extends \yii\db\ActiveRecord
{
    public $district_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cityzone';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['province_id'],'required'],
            [['province_id',], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['city_id','district_id'],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'ชื่อโซน',
            'province_id' => 'จังหวัด',
            'city_id' => 'เขต/อำเภอ',
            'district_id' => 'แขวง/ตำบล',
        ];
    }
}
