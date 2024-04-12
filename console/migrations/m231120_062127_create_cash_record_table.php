<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cash_record}}`.
 */
class m231120_062127_create_cash_record_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cash_record}}', [
            'id' => $this->primaryKey(),
            'journal_no' => $this->string(),
            'trans_date' => $this->datetime(),
            'car_id' => $this->integer(),
            'car_tail_id' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'create_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cash_record}}');
    }
}
