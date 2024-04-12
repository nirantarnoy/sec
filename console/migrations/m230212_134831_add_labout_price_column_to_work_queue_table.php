<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%work_queue}}`.
 */
class m230212_134831_add_labout_price_column_to_work_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%work_queue}}', 'labour_price', $this->float());
        $this->addColumn('{{%work_queue}}', 'express_road_price', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%work_queue}}', 'labour_price');
        $this->dropColumn('{{%work_queue}}', 'express_road_price');
    }
}
