<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%customer_invoice}}`.
 */
class m231102_064511_add_final_amount_column_to_customer_invoice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%customer_invoice}}', 'final_amount', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%customer_invoice}}', 'final_amount');
    }
}
