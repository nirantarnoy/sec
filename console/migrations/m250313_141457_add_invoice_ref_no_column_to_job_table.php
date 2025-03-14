<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%job}}`.
 */
class m250313_141457_add_invoice_ref_no_column_to_job_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job}}', 'invoice_ref_no', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job}}', 'invoice_ref_no');
    }
}
