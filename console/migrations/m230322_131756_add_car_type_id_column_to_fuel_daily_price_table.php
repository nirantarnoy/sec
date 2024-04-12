<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%fuel_daily_price}}`.
 */
class m230322_131756_add_car_type_id_column_to_fuel_daily_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%fuel_daily_price}}', 'car_type_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%fuel_daily_price}}', 'car_type_id');
    }
}
