<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quotation_rate}}`.
 */
class m230501_134829_add_quotation_title_id_column_to_quotation_rate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%quotation_rate}}', 'quotation_title_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%quotation_rate}}', 'quotation_title_id');
    }
}
