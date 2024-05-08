<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%stock_sum}}`.
 */
class m240508_075836_add_expired_date_column_to_stock_sum_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%stock_sum}}', 'expired_date', $this->datetime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%stock_sum}}', 'expired_date');
    }
}
