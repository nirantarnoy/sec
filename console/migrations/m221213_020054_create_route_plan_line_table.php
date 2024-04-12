<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%route_plan_line}}`.
 */
class m221213_020054_create_route_plan_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%route_plan_line}}', [
            'id' => $this->primaryKey(),
            'route_plan_id' => $this->integer(),
            'dropoff_place_id' => $this->integer(),
            'dropoff_qty' => $this->float(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%route_plan_line}}');
    }
}
