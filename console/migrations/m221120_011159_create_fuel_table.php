<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fuel}}`.
 */
class m221120_011159_create_fuel_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%fuel}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
            'fuel_type_id' => $this->integer(),
            'status' => $this->integer(),
            'company_id' => $this->integer(),
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
        $this->dropTable('{{%fuel}}');
    }
}
