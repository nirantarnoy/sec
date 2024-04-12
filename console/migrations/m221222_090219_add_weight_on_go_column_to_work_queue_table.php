<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%work_queue}}`.
 */
class m221222_090219_add_weight_on_go_column_to_work_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%work_queue}}', 'weight_on_go', $this->float());
        $this->addColumn('{{%work_queue}}', 'weight_on_back', $this->float());
        $this->addColumn('{{%work_queue}}', 'weight_go_deduct', $this->float());
        $this->addColumn('{{%work_queue}}', 'go_deduct_reason', $this->string());
        $this->addColumn('{{%work_queue}}', 'back_deduct', $this->float());
        $this->addColumn('{{%work_queue}}', 'back_reason', $this->string());
        $this->addColumn('{{%work_queue}}', 'tail_back_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%work_queue}}', 'weight_on_go');
        $this->dropColumn('{{%work_queue}}', 'weight_on_back');
        $this->dropColumn('{{%work_queue}}', 'weight_go_deduct');
        $this->dropColumn('{{%work_queue}}', 'go_deduct_reason');
        $this->dropColumn('{{%work_queue}}', 'back_deduct');
        $this->dropColumn('{{%work_queue}}', 'back_reason');
        $this->dropColumn('{{%work_queue}}', 'tail_back_id');
    }
}
