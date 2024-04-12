<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%route_plan}}`.
 */
class m231218_031718_add_total_distance_back_column_to_route_plan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%route_plan}}', 'total_distance_back', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%route_plan}}', 'total_distance_back');
    }
}
