<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer_invoice_info}}`.
 */
class m230814_021452_create_customer_invoice_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer_invoice_info}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(),
            'email' => $this->string(),
            'phone_no' => $this->string(),
            'tax_id' => $this->integer(),
            'branch' => $this->string(),
            'contact_name' => $this->string(),
            'address' => $this->string(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customer_invoice_info}}');
    }
}
