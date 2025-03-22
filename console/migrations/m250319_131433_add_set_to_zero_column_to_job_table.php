<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%job}}`.
 */
class m250319_131433_add_set_to_zero_column_to_job_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job}}', 'set_to_zero', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job}}', 'set_to_zero');
    }
}
