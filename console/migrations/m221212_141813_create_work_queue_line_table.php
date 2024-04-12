<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work_queue_line}}`.
 */
class m221212_141813_create_work_queue_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work_queue_line}}', [
            'id' => $this->primaryKey(),
            'work_queue_id' => $this->integer(),
            'doc' => $this->string(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%work_queue_line}}');
    }
}
