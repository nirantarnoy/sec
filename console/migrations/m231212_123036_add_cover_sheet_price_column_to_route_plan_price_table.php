<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%route_plan_price}}`.
 */
class m231212_123036_add_cover_sheet_price_column_to_route_plan_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%route_plan_price}}', 'cover_sheet_price', $this->float());
        $this->addColumn('{{%route_plan_price}}', 'overnight_price', $this->float());
        $this->addColumn('{{%route_plan_price}}', 'warehouse_plus_price', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%route_plan_price}}', 'cover_sheet_price');
        $this->dropColumn('{{%route_plan_price}}', 'overnight_price');
        $this->dropColumn('{{%route_plan_price}}', 'warehouse_plus_price');
    }
}
