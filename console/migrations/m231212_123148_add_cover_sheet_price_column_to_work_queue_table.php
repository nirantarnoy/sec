<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%work_queue}}`.
 */
class m231212_123148_add_cover_sheet_price_column_to_work_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%work_queue}}', 'cover_sheet_price', $this->float());
        $this->addColumn('{{%work_queue}}', 'overnight_price', $this->float());
        $this->addColumn('{{%work_queue}}', 'warehouse_plus_price', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%work_queue}}', 'cover_sheet_price');
        $this->dropColumn('{{%work_queue}}', 'overnight_price');
        $this->dropColumn('{{%work_queue}}', 'warehouse_plus_price');
    }
}
