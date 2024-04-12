<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work_type_invoice_info}}`.
 */
class m230823_013727_create_work_type_invoice_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work_type_invoice_info}}', [
            'id' => $this->primaryKey(),
            'work_type_id' => $this->integer(),
            'tax_id' => $this->string(),
            'branch' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'contact_name' => $this->string(),
            'status' => $this->integer(),
            'payment_term_id' => $this->integer(),
            'payment_method_id' => $this->integer(),
            'address' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%work_type_invoice_info}}');
    }
}
