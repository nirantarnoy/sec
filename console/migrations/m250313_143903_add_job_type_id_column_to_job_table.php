<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%job}}`.
 */
class m250313_143903_add_job_type_id_column_to_job_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job}}', 'job_type_id', $this->integer());
        $this->addColumn('{{%job}}', 'install_team_id', $this->integer());
        $this->addColumn('{{%job}}', 'main_distributor_id', $this->integer());
        $this->addColumn('{{%job}}', 'vat_amount', $this->float());
        $this->addColumn('{{%job}}', 'paid_amount', $this->float());
        $this->addColumn('{{%job}}', 'pending_amount', $this->float());
        $this->addColumn('{{%job}}', 'payment_amount', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job}}', 'job_type_id');
        $this->dropColumn('{{%job}}', 'install_team_id');
        $this->dropColumn('{{%job}}', 'main_distributor_id');
        $this->dropColumn('{{%job}}', 'vat_amount');
        $this->dropColumn('{{%job}}', 'pending_amount');
        $this->dropColumn('{{%job}}', 'payment_amount');
    }
}
