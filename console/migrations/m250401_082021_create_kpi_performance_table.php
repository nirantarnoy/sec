<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kpi_performance}}`.
 */
class m250401_082021_create_kpi_performance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kpi_performance}}', [
            'id' => $this->primaryKey(),
            'trans_date' => $this->datetime(),
            'team_id' => $this->integer(),
            'rating_per' => $this->float(),
            'personal_goal_per' => $this->float(),
            'high_performance_per' => $this->float(),
            'minimum_per' => $this->float(),
            'low_performance_per' => $this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%kpi_performance}}');
    }
}
