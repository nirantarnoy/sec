<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%cash_record}}`.
 */
class m231123_064003_add_payment_method_id_column_to_cash_record_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cash_record}}', 'payment_method_id', $this->integer());
        $this->addColumn('{{%cash_record}}', 'approve_by', $this->integer());
        $this->addColumn('{{%cash_record}}', 'cashier_by', $this->integer());
        $this->addColumn('{{%cash_record}}', 'approve_date', $this->datetime());
        $this->addColumn('{{%cash_record}}', 'cashier_date', $this->datetime());
        $this->addColumn('{{%cash_record}}', 'recieve_by', $this->integer());
        $this->addColumn('{{%cash_record}}', 'recieve_date', $this->datetime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cash_record}}', 'payment_method_id');
        $this->dropColumn('{{%cash_record}}', 'approve_by');
        $this->dropColumn('{{%cash_record}}', 'cashier_by');
        $this->dropColumn('{{%cash_record}}', 'approve_date');
        $this->dropColumn('{{%cash_record}}', 'cashier_date');
        $this->dropColumn('{{%cash_record}}', 'recieve_by');
        $this->dropColumn('{{%cash_record}}', 'recieve_date');
    }
}
