<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%delivery_order_line}}`.
 */
class m240520_151548_add_description_column_to_delivery_order_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%delivery_order_line}}', 'description', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%delivery_order_line}}', 'description');
    }
}
