<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%cash_record_line}}`.
 */
class m240305_040332_add_vat_amount_column_to_cash_record_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cash_record_line}}', 'vat_amount', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cash_record_line}}', 'vat_amount');
    }
}
