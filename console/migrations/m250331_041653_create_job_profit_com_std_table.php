<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%job_profit_com_std}}`.
 */
class m250331_041653_create_job_profit_com_std_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%job_profit_com_std}}', [
            'id' => $this->primaryKey(),
            'job_id' => $this->integer(),
            'std_amount' => $this->float(),
            'commission_per' => $this->float(),
            'commission_amount' => $this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%job_profit_com_std}}');
    }
}
