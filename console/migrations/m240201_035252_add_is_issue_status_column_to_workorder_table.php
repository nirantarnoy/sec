<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%workorder}}`.
 */
class m240201_035252_add_is_issue_status_column_to_workorder_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%workorder}}', 'is_issue_status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%workorder}}', 'is_issue_status');
    }
}
