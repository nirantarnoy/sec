<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%job_deduct}}`.
 */
class m250221_041815_create_job_deduct_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%job_deduct}}', [
            'id' => $this->primaryKey(),
            'job_id' => $this->integer(),
            'deduct_title_id' => $this->integer(),
            'trans_date' => $this->datetime(),
            'amount' => $this->float(),
            'note' => $this->string(),
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
        $this->dropTable('{{%job_deduct}}');
    }
}
