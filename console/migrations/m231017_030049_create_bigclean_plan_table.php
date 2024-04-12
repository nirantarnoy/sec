<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bigclean_plan}}`.
 */
class m231017_030049_create_bigclean_plan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bigclean_plan}}', [
            'id' => $this->primaryKey(),
            'bigplan_id' => $this->integer(),
            'bigplan_date' => $this->datetime(),
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
        $this->dropTable('{{%bigclean_plan}}');
    }
}
