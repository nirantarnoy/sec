<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%route_plan}}`.
 */
class m221228_034307_add_item_back_id_column_to_route_plan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%route_plan}}', 'item_back_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%route_plan}}', 'item_back_id');
    }
}
