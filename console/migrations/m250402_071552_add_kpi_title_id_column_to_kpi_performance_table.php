<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%kpi_performance}}`.
 */
class m250402_071552_add_kpi_title_id_column_to_kpi_performance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%kpi_performance}}', 'kpi_title_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%kpi_performance}}', 'kpi_title_id');
    }
}
