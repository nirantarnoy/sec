<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%job}}`.
 */
class m250311_064407_add_job_master_id_column_to_job_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job}}', 'job_master_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job}}', 'job_master_id');
    }
}
