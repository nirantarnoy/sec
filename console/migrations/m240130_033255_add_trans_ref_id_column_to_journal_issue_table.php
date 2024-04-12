<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%journal_issue}}`.
 */
class m240130_033255_add_trans_ref_id_column_to_journal_issue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%journal_issue}}', 'trans_ref_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%journal_issue}}', 'trans_ref_id');
    }
}
