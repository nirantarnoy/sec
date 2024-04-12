<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%work_queue}}`.
 */
class m221221_104329_add_car_id_column_to_work_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%work_queue}}', 'car_id', $this->integer());
        $this->addColumn('{{%work_queue}}', 'tail_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%work_queue}}', 'car_id');
        $this->dropColumn('{{%work_queue}}', 'tail_id');
    }
}
