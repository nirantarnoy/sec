<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_doc}}`.
 */
class m230119_135420_create_company_doc_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company_doc}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer(),
            'doc_name' => $this->string(),
            'description' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%company_doc}}');
    }
}
