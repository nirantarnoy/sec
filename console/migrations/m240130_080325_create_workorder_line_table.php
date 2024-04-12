<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workorder_line}}`.
 */
class m240130_080325_create_workorder_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workorder_line}}', [
            'id' => $this->primaryKey(),
            'workorder_id' => $this->integer(),
            'description' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%workorder_line}}');
    }
}
