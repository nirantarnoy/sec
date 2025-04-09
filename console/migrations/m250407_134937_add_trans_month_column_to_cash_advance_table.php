<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%cash_advance}}`.
 */
class m250407_134937_add_trans_month_column_to_cash_advance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cash_advance}}', 'trans_month', $this->integer());
        $this->addColumn('{{%cash_advance}}', 'trans_year', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cash_advance}}', 'trans_month');
        $this->dropColumn('{{%cash_advance}}', 'trans_year');
    }
}
