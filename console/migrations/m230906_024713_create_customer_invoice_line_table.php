<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer_invoice_line}}`.
 */
class m230906_024713_create_customer_invoice_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer_invoice_line}}', [
            'id' => $this->primaryKey(),
            'invoice_id' => $this->integer(),
            'item_name' => $this->string(),
            'qty' => $this->float(),
            'price' => $this->float(),
            'line_total' => $this->float(),
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
