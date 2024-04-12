<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%doc_control}}`.
 */
class m240331_004426_create_doc_control_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%doc_control}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
            'doc_file' => $this->string(),
            'company_id' => $this->integer(),
            'start_date' => $this->datetime(),
            'exp_date' => $this->datetime(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%doc_control}}');
    }
}
