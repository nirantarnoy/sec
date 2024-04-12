<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%purch_order}}`.
 */
class m240127_140846_create_purch_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%purch_order}}', [
            'id' => $this->primaryKey(),
            'purch_no' => $this->string(),
            'trans_date' => $this->datetime(),
            'department_id' => $this->integer(),
            'reason' => $this->string(),
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
        $this->dropTable('{{%purch_order}}');
    }
}
