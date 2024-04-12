<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%workorder}}`.
 */
class m240130_074900_add_car_type_id_column_to_workorder_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%workorder}}', 'car_type_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%workorder}}', 'car_type_id');
    }
}
