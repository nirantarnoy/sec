<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reciept_record_line".
 *
 * @property int $id
 * @property int|null $reciept_record_id
 * @property int|null $receipt_title_id
 * @property float|null $amount
 * @property int|null $ref_id
 * @property string|null $ref_no
 * @property string|null $remark
 * @property int|null $status
 */
class RecieptRecordLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reciept_record_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reciept_record_id', 'receipt_title_id', 'ref_id', 'status'], 'integer'],
            [['amount'], 'number'],
            [['ref_no', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reciept_record_id' => 'Reciept Record ID',
            'receipt_title_id' => 'Receipt Title ID',
            'amount' => 'Amount',
            'ref_id' => 'Ref ID',
            'ref_no' => 'Ref No',
            'remark' => 'Remark',
            'status' => 'Status',
        ];
    }
}
