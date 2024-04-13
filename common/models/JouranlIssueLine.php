<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jouranl_issue_line".
 *
 * @property int $id
 * @property int|null $journal_issue_id
 * @property int|null $product_id
 * @property float|null $qty
 * @property float|null $price
 * @property float|null $line_total
 * @property int|null $status
 * @property string|null $remark
 */
class JouranlIssueLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jouranl_issue_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['journal_issue_id', 'product_id', 'status'], 'integer'],
            [['qty', 'price', 'line_total'], 'number'],
            [['remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'journal_issue_id' => 'Journal Issue ID',
            'product_id' => 'Product ID',
            'qty' => 'Qty',
            'price' => 'Price',
            'line_total' => 'Line Total',
            'status' => 'Status',
            'remark' => 'Remark',
        ];
    }
}
