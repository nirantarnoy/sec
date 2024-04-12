<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%car_loan_trans}}`.
 */
class m230925_022147_add_created_at_column_to_car_loan_trans_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%car_loan_trans}}', 'created_at', $this->integer());
        $this->addColumn('{{%car_loan_trans}}', 'created_by', $this->integer());
        $this->addColumn('{{%car_loan_trans}}', 'updated_at', $this->integer());
        $this->addColumn('{{%car_loan_trans}}', 'updated_by', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%car_loan_trans}}', 'created_at');
        $this->dropColumn('{{%car_loan_trans}}', 'created_by');
        $this->dropColumn('{{%car_loan_trans}}', 'updated_at');
        $this->dropColumn('{{%car_loan_trans}}', 'updated_by');
    }
}
