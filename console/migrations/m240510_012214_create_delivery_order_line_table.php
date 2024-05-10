<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%delivery_order_line}}`.
 */
class m240510_012214_create_delivery_order_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%delivery_order_line}}', [
            'id' => $this->primaryKey(),
            'delivery_order_id' => $this->integer(),
            'product_id' => $this->integer(),
            'name' => $this->string(),
            'qty' => $this->float(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%delivery_order_line}}');
    }
}
