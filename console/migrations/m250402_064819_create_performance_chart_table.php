<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%performance_chart}}`.
 */
class m250402_064819_create_performance_chart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%performance_chart}}', [
            'id' => $this->primaryKey(),
            'perform_year' => $this->integer(),
            'perform_month' => $this->integer(),
            'team_id' => $this->integer(),
            'emp_id' => $this->integer(),
            'sale_amount_month' => $this->float(),
            'sale_per_month' => $this->float(),
            'profit_amount' => $this->float(),
            'profit_per' => $this->float(),
            'job_quantity' => $this->integer(),
            'job_quantity_per' => $this->float(),
            'time_atten_per' => $this->float(),
            'personal_perform_per' => $this->float(),
            'hight_perform_per' => $this->float(),
            'low_perform_per' => $this->float(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%performance_chart}}');
    }
}
