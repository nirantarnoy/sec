<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%job_deduct}}`.
 */
class m250228_083308_add_is_vat_column_to_job_deduct_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job_deduct}}', 'is_vat', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job_deduct}}', 'is_vat');
    }
}
