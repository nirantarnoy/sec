<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%fuel_daily_price}}`.
 */
class m230104_040106_add_price_origin_column_to_fuel_daily_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%fuel_daily_price}}', 'price_origin', $this->float());
        $this->addColumn('{{%fuel_daily_price}}', 'price_add', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%fuel_daily_price}}', 'price_origin');
        $this->dropColumn('{{%fuel_daily_price}}', 'price_add');
    }
}
