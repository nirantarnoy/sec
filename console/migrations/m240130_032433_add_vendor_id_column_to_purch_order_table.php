<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%purch_order}}`.
 */
class m240130_032433_add_vendor_id_column_to_purch_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%purch_order}}', 'vendor_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%purch_order}}', 'vendor_id');
    }
}
