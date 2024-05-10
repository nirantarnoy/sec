<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer_invoice_line}}`.
 */
class m240510_012525_create_customer_invoice_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer_invoice_line}}', [
            'id' => $this->primaryKey(),
            'customer_invoice_id' => $this->integer(),
            'product_id' => $this->integer(),
            'qty' => $this->float(),
            'price' => $this->float(),
            'line_discount' => $this->float(),
            'line_amount' => $this->float(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customer_invoice_line}}');
    }
}
