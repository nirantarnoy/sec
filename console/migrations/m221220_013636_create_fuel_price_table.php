<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fuel_price}}`.
 */
class m221220_013636_create_fuel_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%fuel_price}}', [
            'id' => $this->primaryKey(),
            'fuel_id' => $this->integer(),
            'price_date' => $this->datetime(),
            'price' => $this->float(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%fuel_price}}');
    }
}
