<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%job_line}}`.
 */
class m250327_063325_add_distributor_id_column_to_job_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job_line}}', 'distributor_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job_line}}', 'distributor_id');
    }
}
