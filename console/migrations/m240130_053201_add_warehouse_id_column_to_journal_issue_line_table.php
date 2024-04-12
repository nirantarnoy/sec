<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%journal_issue_line}}`.
 */
class m240130_053201_add_warehouse_id_column_to_journal_issue_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%journal_issue_line}}', 'warehouse_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%journal_issue_line}}', 'warehouse_id');
    }
}
