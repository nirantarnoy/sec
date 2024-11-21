<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quotation_line".
 *
 * @property int $id
 * @property int|null $quotation_id
 * @property int|null $product_id
 * @property float|null $qty
 * @property int|null $unit_id
 * @property float|null $line_price
 * @property float|null $line_total
 * @property int|null $status
 */
class QuotationLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quotation_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quotation_id', 'product_id', 'unit_id', 'status'], 'integer'],
            [['qty', 'line_price', 'line_total'], 'number'],
            [['product_name','size_desc','mat_desc','photo'],'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quotation_id' => 'Quotation ID',
            'product_id' => 'Product ID',
            'qty' => 'Qty',
            'unit_id' => 'Unit ID',
            'line_price' => 'Line Price',
            'line_total' => 'Line Total',
            'size_desc' => 'Size',
            'mat_desc' => 'Mat',
            'status' => 'Status',
        ];
    }
}
