<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%delivery_order}}`.
 */
class m240510_012110_create_delivery_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%delivery_order}}', [
            'id' => $this->primaryKey(),
            'order_no' => $this->string(),
            'trans_date' => $this->datetime(),
            'issue_ref_id' => $this->integer(),
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
        $this->dropTable('{{%delivery_order}}');
    }
}
