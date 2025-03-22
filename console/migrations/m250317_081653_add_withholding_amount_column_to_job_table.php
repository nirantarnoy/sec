<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%job}}`.
 */
class m250317_081653_add_withholding_amount_column_to_job_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job}}', 'withholding_amount', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job}}', 'withholding_amount');
    }
}
