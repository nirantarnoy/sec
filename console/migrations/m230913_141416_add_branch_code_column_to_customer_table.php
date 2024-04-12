<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%customer}}`.
 */
class m230913_141416_add_branch_code_column_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%customer}}', 'branch_code', $this->string());
        $this->addColumn('{{%customer}}', 'branch_name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%customer}}', 'branch_code');
        $this->dropColumn('{{%customer}}', 'branch_name');
    }
}
