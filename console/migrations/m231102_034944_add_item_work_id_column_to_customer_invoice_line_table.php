<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%customer_invoice_line}}`.
 */
class m231102_034944_add_item_work_id_column_to_customer_invoice_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%customer_invoice_line}}', 'item_work_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%customer_invoice_line}}', 'item_work_id');
    }
}
