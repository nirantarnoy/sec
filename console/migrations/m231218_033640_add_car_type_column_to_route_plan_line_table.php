<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%route_plan_line}}`.
 */
class m231218_033640_add_car_type_column_to_route_plan_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%route_plan_line}}', 'car_type', $this->integer());
        $this->addColumn('{{%route_plan_line}}', 'lite_oil_rate', $this->float());
        $this->addColumn('{{%route_plan_line}}', 'count_go', $this->float());
        $this->addColumn('{{%route_plan_line}}', 'count_back', $this->float());
        $this->addColumn('{{%route_plan_line}}', 'total', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%route_plan_line}}', 'car_type');
        $this->dropColumn('{{%route_plan_line}}', 'lite_oil_rate');
        $this->dropColumn('{{%route_plan_line}}', 'count_go');
        $this->dropColumn('{{%route_plan_line}}', 'count_back');
        $this->dropColumn('{{%route_plan_line}}', 'total');
    }
}
