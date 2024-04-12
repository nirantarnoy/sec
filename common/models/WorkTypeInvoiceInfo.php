<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "work_type_invoice_info".
 *
 * @property int $id
 * @property int|null $work_type_id
 * @property string|null $tax_id
 * @property string|null $branch
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $contact_name
 * @property int|null $status
 * @property int|null $payment_term_id
 * @property int|null $payment_method_id
 * @property string|null $address
 */
class WorkTypeInvoiceInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_type_invoice_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['work_type_id', 'status', 'payment_term_id', 'payment_method_id'], 'integer'],
            [['tax_id', 'branch', 'phone', 'email', 'contact_name', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'work_type_id' => 'Work Type ID',
            'tax_id' => 'Tax ID',
            'branch' => 'Branch',
            'phone' => 'Phone',
            'email' => 'Email',
            'contact_name' => 'Contact Name',
            'status' => 'Status',
            'payment_term_id' => 'Payment Term ID',
            'payment_method_id' => 'Payment Method ID',
            'address' => 'Address',
        ];
    }
}
