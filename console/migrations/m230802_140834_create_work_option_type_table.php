<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work_option_type}}`.
 */
class m230802_140834_create_work_option_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work_option_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%work_option_type}}');
    }
}
