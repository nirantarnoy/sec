<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "bank_account".
 *
 * @property int $id
 * @property string|null $account_name
 * @property string|null $description
 * @property int|null $bank_id
 * @property string|null $account_no
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class BankAccount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bank_account';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['account_name', 'bank_id', 'account_no'], 'required'],
            [['bank_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['account_name', 'description', 'account_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'account_name' => 'ชื่อบัญชี',
            'description' => 'รายละเอียด',
            'bank_id' => 'ธนาคาร',
            'account_no' => 'เลขที่บัญชี',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
