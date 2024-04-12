<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%route_plan}}`.
 */
class m230212_130524_add_car_type_id_column_to_route_plan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%route_plan}}', 'car_type_id', $this->integer());
        $this->addColumn('{{%route_plan}}', 'labour_price', $this->float());
        $this->addColumn('{{%route_plan}}', 'express_road_price', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%route_plan}}', 'car_type_id');
        $this->dropColumn('{{%route_plan}}', 'labour_price');
        $this->dropColumn('{{%route_plan}}', 'express_road_price');
    }
}
