<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%fuel_daily_price}}`.
 */
class m230419_025907_add_cityzone_id_column_to_fuel_daily_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%fuel_daily_price}}', 'cityzone_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%fuel_daily_price}}', 'cityzone_id');
    }
}
