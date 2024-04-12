<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%route_plan_price}}`.
 */
class m230213_113416_create_route_plan_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%route_plan_price}}', [
            'id' => $this->primaryKey(),
            'route_plan_id' => $this->integer(),
            'car_type_id' => $this->integer(),
            'labour_price' => $this->float(),
            'express_road_price' => $this->float(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%route_plan_price}}');
    }
}
