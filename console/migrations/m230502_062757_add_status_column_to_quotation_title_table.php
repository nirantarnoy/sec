<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quotation_title}}`.
 */
class m230502_062757_add_status_column_to_quotation_title_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%quotation_title}}', 'status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%quotation_title}}', 'status');
    }
}
