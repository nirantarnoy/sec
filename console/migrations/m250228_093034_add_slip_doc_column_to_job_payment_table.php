<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%job_payment}}`.
 */
class m250228_093034_add_slip_doc_column_to_job_payment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job_payment}}', 'slip_doc', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job_payment}}', 'slip_doc');
    }
}
