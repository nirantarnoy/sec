<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quotation}}`.
 */
class m241017_071549_add_total_text_column_to_quotation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%quotation}}', 'total_text', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%quotation}}', 'total_text');
    }
}
