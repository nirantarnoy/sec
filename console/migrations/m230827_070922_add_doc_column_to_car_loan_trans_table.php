<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%car_loan_trans}}`.
 */
class m230827_070922_add_doc_column_to_car_loan_trans_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%car_loan_trans}}', 'doc', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%car_loan_trans}}', 'doc');
    }
}
