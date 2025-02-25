<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%stock_trans}}`.
 */
class m250225_134948_add_warehouse_id_column_to_stock_trans_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%stock_trans}}', 'warehouse_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%stock_trans}}', 'warehouse_id');
    }
}
