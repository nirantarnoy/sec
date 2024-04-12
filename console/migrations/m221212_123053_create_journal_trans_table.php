<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%journal_trans}}`.
 */
class m221212_123053_create_journal_trans_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%journal_trans}}', [
            'id' => $this->primaryKey(),
            'journal_no' => $this->string(),
            'trans_type' => $this->integer(),
            'company_id' => $this->integer(),
            'create_at' => $this->integer(),
            'created_by' => $this->integer(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%journal_trans}}');
    }
}
