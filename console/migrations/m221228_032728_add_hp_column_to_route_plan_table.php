<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%route_plan}}`.
 */
class m221228_032728_add_hp_column_to_route_plan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%route_plan}}', 'hp', $this->integer());
        $this->addColumn('{{%route_plan}}', 'oil_rate_qty', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%route_plan}}', 'hp');
        $this->dropColumn('{{%route_plan}}', 'oil_rate_qty');
    }
}
