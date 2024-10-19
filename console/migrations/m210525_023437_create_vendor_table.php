<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vendor}}`.
 */
class m210525_023437_create_vendor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vendor}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(),
            'name' => $this->string(),
            'vendor_group_id' => $this->integer(),
            'description' => $this->string(),
            'payment_method_id' => $this->integer(),
            'payment_term_id' => $this->integer(),
            'location' => $this->string(),
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
        $this->dropTable('{{%vendor}}');
    }
}
