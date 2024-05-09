<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property string|null $sku
 * @property string|null $barcode
 * @property int|null $product_group_id
 * @property int|null $unit_id
 * @property float|null $cost_price
 * @property string|null $description
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property string|null $exp_date
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
            [['product_group_id', 'unit_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['cost_price','sale_price','total_qty'], 'number'],
            [['exp_date'], 'safe'],
            [['code', 'name', 'sku', 'barcode', 'description','photo','photo_2'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'รหัสสินค้า',
            'name' => 'ชื่อสินค้า',
            'sku' => 'Sku',
            'barcode' => 'Barcode',
            'product_group_id' => 'ประเภทสินค้า',
            'unit_id' => 'หน่วยนับ',
            'cost_price' => 'ราคาทุน',
            'description' => 'รายละเอียดสินค้า',
            'status' => 'สถานะ',
            'photo' => 'รูปภาพ',
            'photo_2' => 'รูปภาพ',
            'sale_price' => 'ราคา',
            'total_qty' =>'จำนวนทั้งหมด',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'exp_date' => 'Exp Date',
        ];
    }
}
