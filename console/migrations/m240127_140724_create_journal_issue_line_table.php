<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%journal_issue_line}}`.
 */
class m240127_140724_create_journal_issue_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%journal_issue_line}}', [
            'id' => $this->primaryKey(),
            'journal_issue_id' => $this->integer(),
            'product_id' => $this->integer(),
            'qry' => $this->float(),
            'status' => $this->integer(),
            'reason' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%journal_issue_line}}');
    }
}
