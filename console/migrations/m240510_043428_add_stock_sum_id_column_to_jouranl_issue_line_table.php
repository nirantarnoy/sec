<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%jouranl_issue_line}}`.
 */
class m240510_043428_add_stock_sum_id_column_to_jouranl_issue_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%jouranl_issue_line}}', 'stock_sum_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%jouranl_issue_line}}', 'stock_sum_id');
    }
}
