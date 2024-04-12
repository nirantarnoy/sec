<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer_assign_list}}`.
 */
class m240108_130954_create_customer_assign_list_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer_assign_list}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(),
            'group_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customer_assign_list}}');
    }
}
