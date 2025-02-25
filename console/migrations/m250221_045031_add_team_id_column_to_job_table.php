<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%job}}`.
 */
class m250221_045031_add_team_id_column_to_job_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job}}', 'team_id', $this->integer());
        $this->addColumn('{{%job}}', 'head_id', $this->integer());
        $this->addColumn('{{%job}}', 'payment_status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job}}', 'team_id');
        $this->dropColumn('{{%job}}', 'head_id');
        $this->dropColumn('{{%job}}', 'payment_status');
    }
}
