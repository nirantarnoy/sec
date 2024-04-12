<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fuel_price".
 *
 * @property int $id
 * @property int|null $fuel_id
 * @property string|null $price_date
 * @property float|null $price
 * @property int|null $status
 */
class FuelPrice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fuel_price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fuel_id', 'status'], 'integer'],
            [['price_date'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fuel_id' => 'Fuel ID',
            'price_date' => 'Price Date',
            'price' => 'Price',
            'status' => 'Status',
        ];
    }
}
