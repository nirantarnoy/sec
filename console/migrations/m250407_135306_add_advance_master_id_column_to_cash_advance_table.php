<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%cash_advance}}`.
 */
class m250407_135306_add_advance_master_id_column_to_cash_advance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cash_advance}}', 'advance_master_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cash_advance}}', 'advance_master_id');
    }
}
