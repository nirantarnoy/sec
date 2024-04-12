<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%route_plan_price}}`.
 */
class m240216_131749_add_trail_id_column_to_route_plan_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%route_plan_price}}', 'trail_id', $this->integer());
        $this->addColumn('{{%route_plan_price}}', 'trail_labour_price', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%route_plan_price}}', 'trail_id');
        $this->dropColumn('{{%route_plan_price}}', 'trail_labour_price');
    }
}
