<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%employee}}`.
 */
class m230701_121846_add_passport_no_column_to_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%employee}}', 'passport', $this->string());
        $this->addColumn('{{%employee}}', 'passport_issue_date', $this->datetime());
        $this->addColumn('{{%employee}}', 'passport_exp_date', $this->datetime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%employee}}', 'passport');
        $this->dropColumn('{{%employee}}', 'passport_issue_date');
        $this->dropColumn('{{%employee}}', 'passport_exp_date');
    }
}
