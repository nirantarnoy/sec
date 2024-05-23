<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%delivery_order_cal}}`.
 */
class m240523_071712_add_issue_qty_column_to_delivery_order_cal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%delivery_order_cal}}', 'issue_qty', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%delivery_order_cal}}', 'issue_qty');
    }
}
