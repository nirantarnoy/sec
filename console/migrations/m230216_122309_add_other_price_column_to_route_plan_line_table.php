<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%route_plan_line}}`.
 */
class m230216_122309_add_other_price_column_to_route_plan_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%route_plan_line}}', 'other_price', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%route_plan_line}}', 'other_price');
    }
}
