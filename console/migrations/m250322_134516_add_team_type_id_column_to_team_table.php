<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%team}}`.
 */
class m250322_134516_add_team_type_id_column_to_team_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%team}}', 'team_type_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%team}}', 'team_type_id');
    }
}
