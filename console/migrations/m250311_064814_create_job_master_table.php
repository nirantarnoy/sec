<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%job_master}}`.
 */
class m250311_064814_create_job_master_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%job_master}}', [
            'id' => $this->primaryKey(),
            'team_id' => $this->integer(),
            'emp_id' => $this->integer(),
            'job_month' => $this->datetime(),
            'approve_payment_status' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%job_master}}');
    }
}
