<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work_queue_dropoff}}`.
 */
class m231120_023000_create_work_queue_dropoff_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work_queue_dropoff}}', [
            'id' => $this->primaryKey(),
            'work_queue_id' => $this->integer(),
            'dropoff_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%work_queue_dropoff}}');
    }
}
