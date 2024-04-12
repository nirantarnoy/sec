<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%route_plan_line}}`.
 */
class m240108_144003_add_hp_column_to_route_plan_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%route_plan_line}}', 'hp', $this->float());
        $this->addColumn('{{%route_plan_line}}', 'oil_rate', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%route_plan_line}}', 'hp');
        $this->dropColumn('{{%route_plan_line}}', 'oil_rate');
    }
}
