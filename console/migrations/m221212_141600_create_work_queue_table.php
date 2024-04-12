<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work_queue}}`.
 */
class m221212_141600_create_work_queue_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work_queue}}', [
            'id' => $this->primaryKey(),
            'work_queue_no' => $this->string(),
            'work_queue_date' => $this->datetime(),
            'customer_id' => $this->integer(),
            'emp_assign' => $this->integer(),
            'customer_id'=> $this->integer(),
            'status' => $this->integer(),
            'create_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%work_queue}}');
    }
}
