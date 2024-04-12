<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%cash_record}}`.
 */
class m231123_040435_add_trans_ref_id_column_to_cash_record_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cash_record}}', 'trans_ref_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cash_record}}', 'trans_ref_id');
    }
}
