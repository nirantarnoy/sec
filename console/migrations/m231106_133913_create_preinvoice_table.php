<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%preinvoice}}`.
 */
class m231106_133913_create_preinvoice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%preinvoice}}', [
            'id' => $this->primaryKey(),
            'journal_no' => $this->string(),
            'journal_date' => $this->datetime(),
            'name' => $this->string(),
            'description' => $this->string(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%preinvoice}}');
    }
}
