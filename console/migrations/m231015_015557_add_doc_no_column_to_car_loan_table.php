<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%car_loan}}`.
 */
class m231015_015557_add_doc_no_column_to_car_loan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%car_loan}}', 'doc_no', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%car_loan}}', 'doc_no');
    }
}
