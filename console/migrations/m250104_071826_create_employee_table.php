<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employee}}`.
 */
class m250104_071826_create_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employee}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'f_name' => $this->string(),
            'l_name' => $this->string(),
            'emp_type_id' => $this->integer(),
            'position_id' => $this->integer(),
            'description' => $this->string(),
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
        $this->dropTable('{{%employee}}');
    }
}
