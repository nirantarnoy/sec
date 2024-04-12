<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work_queue_itemback}}`.
 */
class m231120_031347_create_work_queue_itemback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work_queue_itemback}}', [
            'id' => $this->primaryKey(),
            'work_queue_id' => $this->integer(),
            'item_back_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%work_queue_itemback}}');
    }
}
