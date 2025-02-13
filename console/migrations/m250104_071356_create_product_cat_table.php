<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_cat}}`.
 */
class m250104_071356_create_product_cat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_cat}}', [
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
        $this->dropTable('{{%product_cat}}');
    }
}
