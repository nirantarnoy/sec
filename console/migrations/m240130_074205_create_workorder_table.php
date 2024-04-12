<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workorder}}`.
 */
class m240130_074205_create_workorder_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workorder}}', [
            'id' => $this->primaryKey(),
            'trans_date' => $this->datetime(),
            'workorder_no' => $this->string(),
            'emp_inform_id' => $this->integer(),
            'car_id' => $this->integer(),
            'mile_data' => $this->integer(),
            'is_other' => $this->integer(),
            'other_text' => $this->string(),
            'approval_emp_id' => $this->integer(),
            'emp_notify_id' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
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
        $this->dropTable('{{%workorder}}');
    }
}
