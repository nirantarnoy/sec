<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%employee}}`.
 */
class m250104_092337_add_salary_type_column_to_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%employee}}', 'salary_type', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%employee}}', 'salary_type');
    }
}
