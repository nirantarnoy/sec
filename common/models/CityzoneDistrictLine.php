<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cityzone_district_line".
 *
 * @property int $id
 * @property int|null $cityzone_id
 * @property int|null $province_id
 * @property int|null $city_id
 * @property int|null $district_id
 */
class CityzoneDistrictLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cityzone_district_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cityzone_id', 'province_id', 'city_id', 'district_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cityzone_id' => 'Cityzone ID',
            'province_id' => 'Province ID',
            'city_id' => 'City ID',
            'district_id' => 'District ID',
        ];
    }
}
