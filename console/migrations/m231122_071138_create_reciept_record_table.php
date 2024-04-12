<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reciept_record}}`.
 */
class m231122_071138_create_reciept_record_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reciept_record}}', [
            'id' => $this->primaryKey(),
            'journal_no' => $this->string(),
            'trans_date' => $this->datetime(),
            'status' => $this->integer(),
            'create_at' => $this->integer(),
            'created_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%reciept_record}}');
    }
}
