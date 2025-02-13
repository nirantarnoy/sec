<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work_type}}`.
 */
class m250213_144415_create_work_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
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
        $this->dropTable('{{%work_type}}');
    }
}
