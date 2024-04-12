<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property string|null $description
 * @property int|null $product_type_id
 * @property int|null $product_cat_id
 * @property int|null $status
 * @property float|null $last_price
 * @property float|null $std_price
 * @property int|null $company_id
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'product_cat_id', 'status', 'company_id'], 'integer'],
            [['last_price', 'std_price'], 'number'],
            [['code', 'name', 'description'], 'string', 'max' => 255],
            [['product_type_id'],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'รหัส',
            'name' => 'ชื่อ',
            'description' => 'รายละเอียด',
            'product_type_id' => 'ประเภทสินค้า',
            'product_cat_id' => 'หมวดหมู่สินค้า',
            'status' => 'สถานะ',
            'last_price' => 'ราคาล่าสุด',
            'std_price' => 'ราคา',
            'company_id' => 'บริษัท',
        ];
    }
}
