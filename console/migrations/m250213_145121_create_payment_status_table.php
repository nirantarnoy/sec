<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%payment_status}}`.
 */
class m250213_145121_create_payment_status_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%payment_status}}', [
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
        $this->dropTable('{{%payment_status}}');
    }
}
