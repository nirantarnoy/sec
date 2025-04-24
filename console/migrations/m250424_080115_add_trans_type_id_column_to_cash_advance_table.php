<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%cash_advance}}`.
 */
class m250424_080115_add_trans_type_id_column_to_cash_advance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cash_advance}}', 'trans_type_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cash_advance}}', 'trans_type_id');
    }
}
