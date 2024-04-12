<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%work_queue}}`.
 */
class m221228_074004_add_approve_status_column_to_work_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%work_queue}}', 'approve_status', $this->integer());
        $this->addColumn('{{%work_queue}}', 'approve_by', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%work_queue}}', 'approve_status');
        $this->dropColumn('{{%work_queue}}', 'approve_by');
    }
}
