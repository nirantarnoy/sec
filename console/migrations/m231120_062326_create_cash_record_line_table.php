<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cash_record_line}}`.
 */
class m231120_062326_create_cash_record_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cash_record_line}}', [
            'id' => $this->primaryKey(),
            'car_record_id' => $this->integer(),
            'cost_title_id' => $this->integer(),
            'amount' => $this->float(),
            'remark' => $this->string(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cash_record_line}}');
    }
}
