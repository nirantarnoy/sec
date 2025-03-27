<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%job}}`.
 */
class m250326_071002_add_job_cost_amount_column_to_job_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job}}', 'job_cost_amount', $this->float());
        $this->addColumn('{{%job}}', 'job_benefit_amount', $this->float());
        $this->addColumn('{{%job}}', 'job_benefit_per', $this->float());
        $this->addColumn('{{%job}}', 'commission_amount', $this->float());
        $this->addColumn('{{%job}}', 'remark', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job}}', 'job_cost_amount');
        $this->dropColumn('{{%job}}', 'job_benefit_amount');
        $this->dropColumn('{{%job}}', 'job_benefit_per');
        $this->dropColumn('{{%job}}', 'commission_amount');
        $this->dropColumn('{{%job}}', 'remark');
    }
}
