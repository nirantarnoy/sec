<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%advance_master}}`.
 */
class m250407_135455_create_advance_master_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%advance_master}}', [
            'id' => $this->primaryKey(),
            'trans_month' => $this->integer(),
            'trans_year' => $this->integer(),
            'team_id' => $this->integer(),
            'total_balance' => $this->float(),
            'created_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%advance_master}}');
    }
}
