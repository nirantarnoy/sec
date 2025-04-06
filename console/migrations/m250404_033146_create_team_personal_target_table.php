<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%team_personal_target}}`.
 */
class m250404_033146_create_team_personal_target_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%team_personal_target}}', [
            'id' => $this->primaryKey(),
            'target_year_id' => $this->integer(),
            'team_target_id' => $this->integer(),
            'emp_id' => $this->integer(),
            'emp_target_amount' => $this->float(),
            'ptar_per' => $this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%team_personal_target}}');
    }
}
