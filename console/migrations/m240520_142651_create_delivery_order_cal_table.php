<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%delivery_order_cal}}`.
 */
class m240520_142651_create_delivery_order_cal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%delivery_order_cal}}', [
            'id' => $this->primaryKey(),
            'delivery_order_id' => $this->integer(),
            'delivery_line_id' => $this->integer(),
            'product_id' => $this->integer(),
            'qty_per_pack' => $this->float(),
            'total_pack' => $this->float(),
            'left_qty' => $this->float(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%delivery_order_cal}}');
    }
}
