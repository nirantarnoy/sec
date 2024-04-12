<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%car}}`.
 */
class m230212_124314_add_labur_price_column_to_car_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%car}}', 'labur_price', $this->float());
        $this->addColumn('{{%car}}', 'express_road_price', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%car}}', 'labur_price');
        $this->dropColumn('{{%car}}', 'express_road_price');
    }
}
