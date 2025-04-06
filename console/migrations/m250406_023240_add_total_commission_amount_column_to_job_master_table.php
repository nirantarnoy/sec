<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%job_master}}`.
 */
class m250406_023240_add_total_commission_amount_column_to_job_master_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job_master}}', 'total_commission_amount', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job_master}}', 'total_commission_amount');
    }
}
