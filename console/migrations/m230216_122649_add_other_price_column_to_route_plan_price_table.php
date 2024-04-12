<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%route_plan_price}}`.
 */
class m230216_122649_add_other_price_column_to_route_plan_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%route_plan_price}}', 'other_price', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%route_plan_price}}', 'other_price');
    }
}
