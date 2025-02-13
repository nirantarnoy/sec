<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%team_line}}`.
 */
class m250213_144643_create_team_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%team_line}}', [
            'id' => $this->primaryKey(),
            'team_id' => $this->integer(),
            'emp_id' => $this->integer(),
            'is_head' => $this->integer(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%team_line}}');
    }
}
