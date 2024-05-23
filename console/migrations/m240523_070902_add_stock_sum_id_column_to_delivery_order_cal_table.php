<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%delivery_order_cal}}`.
 */
class m240523_070902_add_stock_sum_id_column_to_delivery_order_cal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%delivery_order_cal}}', 'stock_sum_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%delivery_order_cal}}', 'stock_sum_id');
    }
}
