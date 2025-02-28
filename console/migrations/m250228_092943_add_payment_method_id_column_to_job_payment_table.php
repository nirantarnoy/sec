<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%job_payment}}`.
 */
class m250228_092943_add_payment_method_id_column_to_job_payment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%job_payment}}', 'payment_method_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%job_payment}}', 'payment_method_id');
    }
}
