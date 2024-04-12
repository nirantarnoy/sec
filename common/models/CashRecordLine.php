<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cash_record_line".
 *
 * @property int $id
 * @property int|null $car_record_id
 * @property int|null $cost_title_id
 * @property float|null $amount
 * @property string|null $remark
 * @property int|null $status
 */
class CashRecordLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cash_record_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_record_id', 'cost_title_id', 'status'], 'integer'],
            [['amount','vat_amount'], 'number'],
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
            'car_record_id' => 'Car Record ID',
            'cost_title_id' => 'Cost Title ID',
            'amount' => 'Amount',
            'vat_amount' => 'Vat Amount',
            'remark' => 'Remark',
            'status' => 'Status',
        ];
    }
}
