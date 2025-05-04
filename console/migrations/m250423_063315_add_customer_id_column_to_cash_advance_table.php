<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%cash_advance}}`.
 */
class m250423_063315_add_customer_id_column_to_cash_advance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cash_advance}}', 'customer_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cash_advance}}', 'customer_id');
    }
}
