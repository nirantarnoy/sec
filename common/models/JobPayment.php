<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "job_payment".
 *
 * @property int $id
 * @property int|null $job_id
 * @property int|null $bank_id
 * @property string|null $trans_date
 * @property float|null $amount
 * @property string|null $note
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class JobPayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'bank_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by','payment_method_id'], 'integer'],
            [['trans_date'], 'safe'],
            [['amount'], 'number'],
            [['note','slip_doc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_id' => 'Job ID',
            'bank_id' => 'Bank ID',
            'trans_date' => 'Trans Date',
            'amount' => 'Amount',
            'note' => 'Note',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
