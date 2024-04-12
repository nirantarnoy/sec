<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%work_queque}}`.
 */
class m240221_134527_add_total_distance_column_to_work_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%work_queue}}', 'total_lite', $this->float());
        $this->addColumn('{{%work_queue}}', 'total_distance', $this->float());
        $this->addColumn('{{%work_queue}}', 'total_amount', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%work_queue}}', 'total_lite');
        $this->dropColumn('{{%work_queue}}', 'total_distance');
        $this->dropColumn('{{%work_queue}}', 'total_amount');
    }
}
