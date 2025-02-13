<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%employee}}`.
 */
class m250104_092814_add_cal_commission_column_to_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%employee}}', 'cal_commission', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%employee}}', 'cal_commission');
    }
}
