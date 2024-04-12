<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%dropoff_place}}`.
 */
class m221227_084735_add_hp_column_to_dropoff_place_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%dropoff_place}}', 'hp', $this->integer());
        $this->addColumn('{{%dropoff_place}}', 'oil_rate_qty', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%dropoff_place}}', 'hp');
        $this->dropColumn('{{%dropoff_place}}', 'oil_rate_qty');
    }
}
