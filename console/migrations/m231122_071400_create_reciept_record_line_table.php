<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reciept_record_line}}`.
 */
class m231122_071400_create_reciept_record_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reciept_record_line}}', [
            'id' => $this->primaryKey(),
            'reciept_record_id' => $this->integer(),
            'receipt_title_id' => $this->integer(),
            'amount' => $this->float(),
            'ref_id' => $this->integer(),
            'ref_no' => $this->string(),
            'remark' => $this->string(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%reciept_record_line}}');
    }
}
