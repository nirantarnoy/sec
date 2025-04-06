<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%team_target}}`.
 */
class m250404_032839_create_team_target_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%team_target}}', [
            'id' => $this->primaryKey(),
            'target_year_id' => $this->integer(),
            'milestone' => $this->string(),
            'monthly_amount' => $this->float(),
            'tele_sell_amount' => $this->float(),
            'installation_amount' => $this->float(),
            'ttar_per' => $this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%team_target}}');
    }
}
