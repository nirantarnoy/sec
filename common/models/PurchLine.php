<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "purch_line".
 *
 * @property int $id
 * @property int|null $purch_id
 * @property int|null $product_id
 * @property float|null $qry
 * @property float|null $line_price
 * @property float|null $line_total
 * @property int|null $status
 */
class PurchLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purch_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['purch_id', 'product_id', 'status'], 'integer'],
            [['qry', 'line_price', 'line_total','remain_qty'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'purch_id' => 'Purch ID',
            'product_id' => 'Product ID',
            'qry' => 'Qry',
            'line_price' => 'Line Price',
            'line_total' => 'Line Total',
            'remain_qty' => 'Remain Qty',
            'status' => 'Status',
        ];
    }
}
