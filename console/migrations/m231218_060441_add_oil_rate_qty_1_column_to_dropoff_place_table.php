<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%dropoff_place}}`.
 */
class m231218_060441_add_oil_rate_qty_1_column_to_dropoff_place_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%dropoff_place}}', 'oil_rate_qty_1', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%dropoff_place}}', 'oil_rate_qty_1');
    }
}
