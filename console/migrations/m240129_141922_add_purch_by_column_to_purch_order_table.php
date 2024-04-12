<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%purch_order}}`.
 */
class m240129_141922_add_purch_by_column_to_purch_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%purch_order}}', 'purch_by', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%purch_order}}', 'purch_by');
    }
}
