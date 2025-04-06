<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%kpi_performance}}`.
 */
class m250403_093741_add_perfrom_year_column_to_kpi_performance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%kpi_performance}}', 'perform_year', $this->integer());
        $this->addColumn('{{%kpi_performance}}', 'perform_month', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%kpi_performance}}', 'perform_year');
        $this->dropColumn('{{%kpi_performance}}', 'perform_month');
    }
}
