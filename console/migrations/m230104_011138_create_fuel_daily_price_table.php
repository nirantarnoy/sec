<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fuel_daily_price}}`.
 */
class m230104_011138_create_fuel_daily_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%fuel_daily_price}}', [
            'id' => $this->primaryKey(),
            'fuel_id' => $this->integer(),
            'province_id' => $this->integer(),
            'city_id' => $this->integer(),
            'price_date' => $this->datetime(),
            'price' => $this->float(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%fuel_daily_price}}');
    }
}
