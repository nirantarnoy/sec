<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%employee}}`.
 */
class m230630_150656_add_id_card_no_column_to_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%employee}}', 'id_card_no', $this->string());
        $this->addColumn('{{%employee}}', 'card_issue_place', $this->string());
        $this->addColumn('{{%employee}}', 'card_issue_date', $this->datetime());
        $this->addColumn('{{%employee}}', 'card_exp_date', $this->datetime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%employee}}', 'id_card_no');
        $this->dropColumn('{{%employee}}', 'card_issue_place');
        $this->dropColumn('{{%employee}}', 'card_issue_date');
        $this->dropColumn('{{%employee}}', 'card_exp_date');
    }
}
