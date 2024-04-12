<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%car_loan}}`.
 */
class m230925_130237_add_loan_amount_column_to_car_loan_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%car_loan}}', 'loan_amount', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%car_loan}}', 'loan_amount');
    }
}
