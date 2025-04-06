<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%job_profit_com_std}}`.
 */
class m250406_021804_add_type_id_column_to_job_profit_com_std_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job_profit_com_std}}', 'type_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job_profit_com_std}}', 'type_id');
    }
}
