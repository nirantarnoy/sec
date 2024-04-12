<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_loan_trans".
 *
 * @property int $id
 * @property int|null $car_loan_id
 * @property string|null $trans_date
 * @property int|null $period_no
 * @property float|null $loan_pay_amt
 * @property int|null $status
 * @property string|null $doc
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class CarLoanTrans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car_loan_trans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_loan_id','loan_pay_amt','trans_date'],'required'],
            [['car_loan_id', 'period_no', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['trans_date'], 'safe'],
            [['loan_pay_amt'], 'number'],
            [['doc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_loan_id' => 'รถ/พ่วง',
            'trans_date' => 'วันที่ชำระ',
            'period_no' => 'งวดที่',
            'loan_pay_amt' => 'ยอดชำระ',
            'status' => 'สถานะ',
            'doc' => 'เอกสารแนบ',
            'created_at' => 'วันที่ทำรายการ',
            'created_by' => 'ทำรายการโดย',
            'updated_at' => 'แก้ไขเมื่อ',
            'updated_by' => 'แก้ไขโดย',
        ];
    }
}
