<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "view_product_page".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property string|null $sku
 * @property string|null $barcode
 * @property int|null $product_group_id
 * @property int|null $unit_id
 * @property string|null $photo
 * @property string|null $photo_2
 * @property float|null $sale_price
 * @property int|null $customer_id
 * @property float|null $customer_sale_price
 * @property float|null $qty
 * @property string|null $expired_date
 * @property int|null $status
 */
class ViewProductPage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_product_page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_group_id', 'unit_id', 'customer_id', 'status'], 'integer'],
            [['sale_price', 'customer_sale_price', 'qty'], 'number'],
            [['expired_date'], 'safe'],
            [['code', 'name', 'sku', 'barcode', 'photo', 'photo_2'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'sku' => 'Sku',
            'barcode' => 'Barcode',
            'product_group_id' => 'Product Group ID',
            'unit_id' => 'Unit ID',
            'photo' => 'Photo',
            'photo_2' => 'Photo 2',
            'sale_price' => 'Sale Price',
            'customer_id' => 'Customer ID',
            'customer_sale_price' => 'Customer Sale Price',
            'qty' => 'Qty',
            'expired_date' => 'Expired Date',
            'status' => 'Status',
        ];
    }
}
