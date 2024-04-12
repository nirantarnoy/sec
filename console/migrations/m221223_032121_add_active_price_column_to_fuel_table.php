<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%fuel}}`.
 */
class m221223_032121_add_active_price_column_to_fuel_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%fuel}}', 'active_price', $this->float());
        $this->addColumn('{{%fuel}}', 'active_price_date', $this->datetime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%fuel}}', 'active_price');
        $this->dropColumn('{{%fuel}}', 'active_price_date');
    }
}
