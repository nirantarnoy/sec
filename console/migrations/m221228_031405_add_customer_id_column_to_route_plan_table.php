<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%route_plan}}`.
 */
class m221228_031405_add_customer_id_column_to_route_plan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%route_plan}}', 'customer_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%route_plan}}', 'customer_id');
    }
}
