<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%job_emp_commission}}`.
 */
class m250331_042014_create_job_emp_commission_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%job_emp_commission}}', [
            'id' => $this->primaryKey(),
            'job_id' => $this->integer(),
            'emp_id' => $this->integer(),
            'commistion_per' => $this->float(),
            'commission_std_amount' => $this->float(),
            'ttar_amount' => $this->float(),
            'ptar_amount' => $this->float(),
            'ppr_amount' => $this->float(),
            'total_commission_amount' => $this->float(),
            'rebate_campaign_amount' => $this->float(),
            'grand_total_commision' => $this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%job_emp_commission}}');
    }
}
