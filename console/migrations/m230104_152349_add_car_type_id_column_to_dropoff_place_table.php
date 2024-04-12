<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%dropoff_place}}`.
 */
class m230104_152349_add_car_type_id_column_to_dropoff_place_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%dropoff_place}}', 'car_type_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%dropoff_place}}', 'car_type_id');
    }
}
