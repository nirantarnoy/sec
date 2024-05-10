<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer_invoice}}`.
 */
class m240510_012412_create_customer_invoice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer_invoice}}', [
            'id' => $this->primaryKey(),
            'invioce_no' => $this->string(),
            'trans_date' => $this->datetime(),
            'order_ref_id' => $this->integer(),
            'total_amount' => $this->float(),
            'vat_amount' => $this->float(),
            'grand_total_amount' => $this->float(),
            'vat_id' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customer_invoice}}');
    }
}
