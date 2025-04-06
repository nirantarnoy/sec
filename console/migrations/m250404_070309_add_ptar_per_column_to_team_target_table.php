<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%team_tartget}}`.
 */
class m250404_070309_add_ptar_per_column_to_team_target_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%team_target}}', 'ptar_per', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%team_target}}', 'ptar_per');
    }
}
