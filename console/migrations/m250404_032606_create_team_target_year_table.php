<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%team_target_year}}`.
 */
class m250404_032606_create_team_target_year_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%team_target_year}}', [
            'id' => $this->primaryKey(),
            'target_year' => $this->integer(),
            'team_id' => $this->integer(),
            'target_amount' => $this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%team_target_year}}');
    }
}
