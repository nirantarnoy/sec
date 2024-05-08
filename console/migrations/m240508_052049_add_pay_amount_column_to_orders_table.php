<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%orders}}`.
 */
class m240508_052049_add_pay_amount_column_to_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%orders}}', 'pay_amount', $this->float());
        $this->addColumn('{{%orders}}', 'pay_status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%orders}}', 'pay_amount');
        $this->dropColumn('{{%orders}}', 'pay_status');
    }
}
