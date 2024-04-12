<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "query_cash_record_recieve".
 *
 * @property int|null $receipt_title_id
 * @property int|null $reciept_record_id
 * @property float|null $amount
 * @property string|null $ref_no
 * @property string|null $remark
 * @property string|null $journal_no
 * @property string|null $trans_date
 * @property int|null $emp_id
 * @property string|null $code
 * @property string|null $fname
 * @property string|null $lname
 */
class QueryCashRecordRecieve extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'query_cash_record_recieve';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['receipt_title_id', 'reciept_record_id', 'emp_id'], 'integer'],
            [['amount'], 'number'],
            [['trans_date'], 'safe'],
            [['ref_no', 'remark', 'journal_no', 'code', 'fname', 'lname'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'receipt_title_id' => 'Receipt Title ID',
            'reciept_record_id' => 'Reciept Record ID',
            'amount' => 'Amount',
            'ref_no' => 'Ref No',
            'remark' => 'Remark',
            'journal_no' => 'Journal No',
            'trans_date' => 'Trans Date',
            'emp_id' => 'Emp ID',
            'code' => 'Code',
            'fname' => 'Fname',
            'lname' => 'Lname',
        ];
    }
}
