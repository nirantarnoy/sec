<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%delivery_order}}`.
 */
class m240516_123717_add_remark_column_to_delivery_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%delivery_order}}', 'remark', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%delivery_order}}', 'remark');
    }
}
