<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%job_payment}}`.
 */
class m250327_042458_add_total_amount_column_to_job_payment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job_payment}}', 'total_amount', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job_payment}}', 'total_amount');
    }
}
