<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%job_line}}`.
 */
class m250327_071148_add_withholding_tax_amount_column_to_job_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job_line}}', 'withholding_tax_amount', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job_line}}', 'withholding_tax_amount');
    }
}
