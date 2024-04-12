<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%cash_record}}`.
 */
class m240307_063115_add_ref_no_column_to_cash_record_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cash_record}}', 'ref_no', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cash_record}}', 'ref_no');
    }
}
