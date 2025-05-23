<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%job_com_share}}`.
 */
class m250406_042033_create_job_com_share_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%job_com_share}}', [
            'id' => $this->primaryKey(),
            'job_id' => $this->integer(),
            'emp_id'=>$this->integer(),
            'share_per' => $this->float(),
            'share_amount' => $this->float(),
            'ttar_amount' => $this->float(),
            'ptar_amount' => $this->float(),
            'ppr_amount' => $this->float(),
            'total_amount' => $this->float(),
            'rebate_amount' => $this->float(),
            'grand_total' => $this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%job_com_share}}');
    }
}
