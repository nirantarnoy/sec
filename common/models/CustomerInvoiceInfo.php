<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer_invoice_info".
 *
 * @property int $id
 * @property int|null $customer_id
 * @property string|null $email
 * @property string|null $phone_no
 * @property int|null $tax_id
 * @property string|null $branch
 * @property string|null $contact_name
 * @property string|null $address
 * @property int|null $status
 */
class CustomerInvoiceInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_invoice_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'tax_id', 'status'], 'integer'],
            [['email', 'phone_no', 'branch', 'contact_name', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'email' => 'Email',
            'phone_no' => 'Phone No',
            'tax_id' => 'Tax ID',
            'branch' => 'Branch',
            'contact_name' => 'Contact Name',
            'address' => 'Address',
            'status' => 'Status',
        ];
    }
}
