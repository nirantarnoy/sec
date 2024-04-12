<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%cash_record}}`.
 */
class m240305_014128_add_work_ref_id_column_to_cash_record_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%cash_record}}', 'work_ref_id', $this->integer());
        $this->addColumn('{{%cash_record}}', 'vat_per', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%cash_record}}', 'work_ref_id');
        $this->dropColumn('{{%cash_record}}', 'vat_per');
    }
}
